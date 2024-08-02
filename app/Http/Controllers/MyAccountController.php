<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contact;
use App\Models\Product;
use App\Models\MyAccount;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\OrdesEcommerce;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use App\Exceptions\CustomException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Models\ProdutosPedidoEcommerce;


class MyAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Você precisa estar logado para acessar esta funcionalidade.');
        }
        $business_id = config('constants.business_id');

        $config = DB::table('config_ecommerces')
            ->where('business_id', $business_id)
            ->get()
            ->toArray();


        return view('minha_conta.menu', ['config'=>$config,
            'user' => $request->user()]);
    }


    public function getDetails()
    {
        $userID = Auth::id();

        $user_details = User::join('contacts', 'contacts.user_id', '=', 'users.id')
                    ->join('cities as ct', 'ct.id', 'contacts.city_id')
                    ->where('users.id', $userID)
                    ->select('users.*', 'contacts.*', 'users.email as eMail', 'ct.nome as cityName', 'ct.uf', 'users.id as user_id')
                    ->whereNull('users.deleted_at')
                    ->first();
        //dd($user_details);


        return view('minha_conta.minha_conta_details', ['user_details'=> $user_details]);
    }


    public function getShippings() : array
    {
        $userID = Auth::id();
        $pedidos = OrdesEcommerce::where('cliente_id', $userID)->get()->toArray();


        return $pedidos;

    }


    public function myShippings()
    {
        $userID = auth()->id();
        $url = config('constants.URL_IMAGES');

        // Recuperar todos os pedidos do usuário
        $orders = OrdesEcommerce::where('cliente_id', $userID )->get();

        if ($orders->isEmpty()) {
            throw new CustomException("Usuário não encontrado", 500);
        }

        // Recuperar todos os produtos associados aos pedidos do usuário
        $products = DB::table('produtos_pedido_ecommerces as pde')
                        ->join('products as p', 'p.id', 'pde.id_produto')
                        ->whereIn('pde.id_pedido', $orders->pluck('id_dunning_asaas'))
                        ->select('pde.*', 'p.name as nome_produto', 'p.image')
                        ->get();

        if ($products->isEmpty()) {
            throw new CustomException("Nenhum produto retornado nessa requisiçao", 500);
        }

        // Agrupar os produtos pelos pedidos
        $groupedOrders = $orders->map(function ($order) use ($products) {
            $order->products = $products->where('id_pedido', $order->id_dunning_asaas);
            return $order;
        });

        $recommendedProducts = Product::where('business_id', 42)
            ->where('ecommerce', 1)
            ->get();

        return view('minha_conta.partials.shopping_details', compact('groupedOrders', 'recommendedProducts', 'url'));
    }

    public function shippingDetails($id)
    {
        $pedido = OrdesEcommerce::where('id', $id)->get()->first();
        $url = config('constants.URL_IMAGES');

        $itens = ProdutosPedidoEcommerce::where('id_pedido', $pedido->id_dunning_asaas)
        ->join('products as p', 'p.id', 'produtos_pedido_ecommerces.id_produto')
        ->join('variations as v', 'v.product_id', 'p.id')
        ->select('p.name as nome',
                'p.image',
                'v.default_sell_price as price')
        ->get()
        ->toArray();
        // dd($pedido, $itens);
        // die;
        if (!$pedido) {
            return response()->json(['error' => 'Pedido não encontrado'], 404);
        }

        return view('minha_conta.partials.shipping_details', compact('pedido', 'itens', 'url'));
    }

    public function updateRegister(Request $request)
    {
        try {

            $user_id = $request->user_id;

            // Validação dos dados
            $request->validate([
                'first_name' => ['required', 'string', 'max:255'],
                'sobrenome' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'cpf_cnpj' => ['required', 'string', 'max:20'],
                'datanasc' => ['nullable', 'date'],
                'cep' => ['nullable', 'string', 'max:10'],
                'rua' => ['nullable', 'string', 'max:255'],
                'bairro' => ['nullable', 'string', 'max:255'],
                'number' => ['nullable', 'string', 'max:10'],
                'mobile' => ['nullable', 'string', 'max:20'],
            ]);

            // Recupera o usuário pelo ID

            $user = User::findOrFail($user_id);

            // Atualiza os dados do usuário
            $user->first_name = $request->first_name;
            $user->last_name = $request->sobrenome;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            // Recupera ou cria o contato associado ao usuário
            $contact = Contact::firstOrNew(['user_id' => $user_id]);
            $contact->business_id = config('constants.business_id');
            $contact->city_id = $request->city_id ?? 77;
            $contact->name = $request->first_name . ' ' . $request->sobrenome;
            $contact->type = 'customer';
            $contact->cod_pais = 1058;
            $contact->consumidor_final = 1;
            $contact->contribuinte = 1;
            $contact->cpf_cnpj = $request->cpf_cnpj;
            $contact->datanasc = $request->datanasc;
            $contact->cep = $request->cep;
            $contact->rua = $request->rua;
            $contact->bairro = $request->bairro;
            $contact->numero = $request->number;
            $contact->mobile = $request->mobile;
            $contact->email = $request->email;
            $contact->is_ecommerce = 1;
            $contact->created_by = $contact->business_id;
            $contact->save();

            // Redirecionamento de sucesso ou resposta adequada
            return redirect()->route('minha-conta-details')->with('success', 'Perfil atualizado com sucesso.');

        } catch (\Exception $e) {
            // Em caso de erro, depuração e retorno apropriado
            dd("Error: " . $e->getMessage(), "Line: " . $e->getLine());
            return back()->withErrors(['error' => 'Ocorreu um erro ao tentar atualizar o perfil do usuário.']);
        }
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(MyAccount $myAccount)
    {
        $user = request()->session()->get('user');
        dd($user);


        return view('minha_conta.perfil');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MyAccount $myAccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MyAccount $myAccount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MyAccount $myAccount)
    {
        //
    }
}
