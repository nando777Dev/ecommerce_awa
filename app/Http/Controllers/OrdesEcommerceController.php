<?php
namespace App\Http\Controllers;

use App\Models\OrdesEcommerce;
use App\Models\ProdutosPedidoEcommerce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class OrdesEcommerceController extends Controller
{
    public function getList()
    {


        if (request()->ajax()) {
            $business_id = request()->session()->get('user.business_id');
            $user_id = request()->session()->get('user.id');

            $userID = Auth::id();

            $pedidos = OrdesEcommerce::where('ordes_ecommerces.cliente_id', $userID)
                ->orderBy('ordes_ecommerces.id', 'desc')
                ->join('contacts', 'contacts.customerId', '=', 'ordes_ecommerces.customer_id')
                ->select(['contacts.name', 'ordes_ecommerces.*']);

            if (!empty(request()->start_date) && !empty(request()->end_date)) {
                $start = request()->start_date;
                $end =  request()->end_date;
                $pedidos->whereDate('ordes_ecommerces.date_created', '>=', $start)
                    ->whereDate('ordes_ecommerces.date_created', '<=', $end);
            }

            return DataTables::of($pedidos)
                ->addColumn('action', function ($row) {
                    return '<a href="#" title="Adicionar venda" class="btn btn-danger btn-xs btn-modal mr-1" data-container=".view_modal" data-href="' . route("products.showModal", [$row->id]) . '"><i class="fa fa-eye"></i></a>';
                })
                ->editColumn(
                    'date_created',
                    function ($row) {
                        return \Carbon\Carbon::parse($row->date_created)->format('d/m/Y');
                    }
                )
                ->editColumn(
                    'vencimento',
                    function ($row) {
                        $data_Vencimento  = \Carbon\Carbon::parse($row->data_vencimento)->format('d/m/Y');
                        if ($row->data_vencimento <= \Carbon\Carbon::now()) {
                            return "<span style='color: red'> $data_Vencimento</span>";
                        }
                        return \Carbon\Carbon::parse($row->data_vencimento)->format('d/m/Y');
                    }
                )
                ->editColumn(
                    'valor_before_taxa',
                    function ($row) {
                        return "R$ " . number_format($row->valor_before_taxa, 2, ',', '.');
                    }
                )
                ->editColumn(
                    'valor_total_after_taxa',
                    function ($row) {
                        return "R$ " . number_format($row->valor_after_taxa, 2, ',', '.');
                    }
                )
                ->editColumn(
                    'billing_type',
                    function ($row) {
                        if ($row->billing_type == 'BOLETO') {
                            return "<span class=' uppercase' style='color: #4cf309'>BOLETO</span>";
                        } else if ($row->billing_type == 'CREDIT_CARD') {
                            return "<span style='color: #012bfd'>CARTÃO DE CRÉDITO</span>";
                        } else if ($row->billing_type == 'PIX') {
                            return "<span style='color: #f60495'>PIX</span>";
                        }
                    }
                )
                ->editColumn(
                    'status',
                    function ($row) {
                        if ($row->status == 'PENDING') {
                            return "<button class='btn-xs btn-warning uppercase'>Pendente</button>";
                        } else if ($row->status == 'RECEIVED') {
                            return "<button class='btn-xs btn-success uppercase'>Confirmado</button>";
                        } else if ($row->status == 'OVERDUE') {
                            return "<button class='btn-xs btn-danger uppercase'>Vencida</button>";
                        } else if ($row->status == 'CONFIRMED') {
                            return "<button class='btn-xs btn-info uppercase'>Confirmado</button>";
                        }
                    }
                )

                ->editColumn(
                    'numbero_fatura',
                    function ($row) {
                        return "<a href='$row->' class='btn-xs btn-warning uppercase'>Pendente</a>";
                    }
                )
                ->removeColumn('contacts.id')
                ->rawColumns(['action', 'status', 'vencimento', 'billing_type'])
                ->make(true);
        }

        return view('minha_conta.partials.list');
    }

    public function showModal($id)
    {
        $pedidos = OrdesEcommerce::where('ordes_ecommerces.id', $id)
            ->orderBy('ordes_ecommerces.id', 'desc')
            ->join('contacts', 'contacts.customerId', '=', 'ordes_ecommerces.customer_id')
            ->select(['contacts.name', 'ordes_ecommerces.*'])
        ->get()
        ->first();

        $url = config('constants.URL_IMAGES');

        $itens = ProdutosPedidoEcommerce::join('products as p', 'p.id', 'produtos_pedido_ecommerces.id_produto')
            ->join('variations as v', 'v.product_id', 'p.id')
            ->leftJoin('variation_location_details as vld', 'vld.variation_id', 'v.id')
            ->where('id_pedido', $pedidos->id_dunning_asaas)
            ->select(
                'v.default_sell_price as price',
                'v.id as variation_id',
                'p.name as nome',
                'p.id as id_produto',
                'p.novo',
                'p.image',
                'p.destaque',
                'product_description as description',
                'vld.qty_available as stock',
            )
            ->get()
            ->toArray();

        if (!$pedidos) {
            return response()->json(['error' => 'Pedido não encontrado'], 404);
        }

        return view('minha_conta.show', compact('pedidos', 'itens', 'url'));
    }
}
