<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Contact;
use App\Models\DummyCart;
use App\Models\TaxRate;
use App\Models\User;
use App\Services\AsaasPhp\Customer\CustomerList;
use App\Services\AsaasPhp\Customer\CustomerSpecific;
use App\Services\AsaasPhp\Payment\PaymentCrete;
use App\Services\AsaasService;
use App\Services\CustomerService;
use App\Services\OrdersEcommerces\Orders\OrderService;
use App\Services\TransactionService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class CheckoutController extends Controller
{

    protected $orderService;
    protected $customerList;

    protected $customerSpecific;

    protected $customerService;

    protected $transactionService;

    protected $asaasService;

    public function __construct(OrderService $orderService,
                                CustomerList $customerList,
                                CustomerSpecific $customerSpecific,
                                CustomerService $customerService,
                                TransactionService $transactionService,
                                AsaasService $asaasService
    )
    {
        $this->orderService = $orderService;
        $this->customerList = $customerList;
        $this->customerSpecific = $customerSpecific;
        $this->customerService = $customerService;
        $this->transactionService = $transactionService;
        $this->asaasService = $asaasService;

        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Você precisa estar logado para acessar esta funcionalidade.');
        }

        $userID = Auth::id();
        $contactDetails = Contact::where('user_id', $userID)->first();

        $business_id = config('constants.business_id');
        $itens = DummyCart::where('usuario_id', $userID)->get()->toArray();
        $url = config('constants.URL_IMAGES');

        $itemCount = count($itens);

        $config  = DB::table('config_gateway_payments')
                ->where('business_id',$business_id )
                ->get();

        $items = $config->first();



        $taxe_rate  = TaxRate::where('business_id', $business_id)->get()->toArray();

        //dd($taxe_rate);

        return view('checkout.index', compact('itens', 'url', 'itemCount', 'contactDetails', 'items', 'taxe_rate'));
    }


    public function getTaxRates()
    {
        // Retorne os dados das taxas do banco de dados
        $business_id = config('constants.business_id');

        $taxRates = TaxRate::where('business_id', $business_id)->get()->toArray();
        return response()->json($taxRates);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $items = $request->input('items');

        $business_id = config('constants.business_id');

        $asaasService = new \App\Services\AsaasService();
        $asaasService->setBusinessId($business_id);

        $userID = Auth::id();
        $input = $request->except('_token');



        $contact = Contact::where('user_id', $userID)->first();

        $result = [];
        // Verifica se o usuario é cadastrado no Asaas
        if(!$contact->customerId){
            $result = $asaasService->createCustomer($contact);
            $contact->update(['customerId' => $result['id']]);
        }

        // Recupera os dados do customer na Asaas para iniciar a venda
        $customerDetails = $asaasService->getCliente($contact->customerId);
        //$customerDetails = $this->customerService->getCustomer($contact->customerId);

        if (isset($input['parcelas'])) {
            list($installments, $installmentValue) = explode('|', $input['parcelas']);
        } else {
            $installments = null;
            $installmentValue = null;

        }
        if($input['billingTypeSelect'] == 'CREDIT_CARD'){
            $post_dunning = $asaasService->createPaymentCreditCrad($request, $installments, $installmentValue, $customerDetails, $business_id, $items);
        }

        $post_dunning = $asaasService->createPayment($input, $installments, $installmentValue, $customerDetails, $business_id, $items);


        $object = json_decode(json_encode($post_dunning));
        if(isset($object->error)){
            echo $object->error;
            die;
        }

        $clearCart = $this->destroy($userID);

        $invoiceUrl = $post_dunning['invoiceUrl'];
        return redirect()->back()->with(['success' => 'Compra concluída com sucesso!', 'redirectUrl' => $invoiceUrl]);

    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    private function destroy($userID)
    {

        $dummy_carts = DummyCart::where('usuario_id', $userID)->delete();

    }
}
