<?php

namespace App\Services;

use App\Exceptions\CustomException;
use Exception;
use App\Models\Business;
use App\Models\BusinessLocation;
use App\Models\OrdesEcommerce;
use App\Models\ProdutosPedidoEcommerce;
use App\Models\Transaction;
use App\Models\TransactionSellLine;
use App\Models\Variation;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AsaasService
{
    private $apiKey;
    private $baseUrl;

    public function __construct()
    {
        $environment = app()->isLocal() ? 'sandbox' : 'production';
        $this->baseUrl = config("asaas.{$environment}_url");
    }

    public function setBusinessId($business_id)
    {
        $this->apiKey = DB::table('config_gateway_payments')
            ->where('business_id', $business_id)
            ->value('api_key');
    }

    public function getCliente($clienteId)
    {
        if (!$this->apiKey) {
            throw new Exception("API key not set. Please set the business ID using setBusinessId method.");
        }

        $url = "{$this->baseUrl}/customers/{$clienteId}";

        $response = Http::withHeaders([
            'accept' => 'application/json',
            'access_token' => $this->apiKey,
        ])->get($url);

        if ($response->failed()) {
            throw new Exception("Error: " . $response->body());
        }

        $customer = $response->json();

        return $customer;
    }

    public function createPayment($input, $installments, $installmentValue, $customerDetails, $business_id, $items)
    {
        if (!$this->apiKey) {
            throw new Exception("API key not set. Please set the business ID using setBusinessId method.");
        }

        $transaction_date = Carbon::now()->toDateString();
        $url = "{$this->baseUrl}/payments";

        $body = [
            'customer' => $customerDetails['id'],
            'billingType' => $input['billingTypeSelect'],
            'value' => $input['total'],
            'installmentCount' => $installments,
            'installmentValue' => $installmentValue,
            'dueDate' => $transaction_date
        ];

        $response = Http::withHeaders([
            'accept' => 'application/json',
            'access_token' => $this->apiKey,
            'content-type' => 'application/json',
        ])->post($url, $body);

        if ($response->failed()) {
            $error = $response->body();
            $decodedError = json_decode($error, true); // Decodifica o JSON em um array associativo

            if (isset($decodedError['errors'][0]['description'])) {
                $errorMessage = $decodedError['errors'][0]['description'];
            } else {
                $errorMessage = "Erro desconhecido";
            }

            throw new CustomException($errorMessage, 502);
        }

        $payment = $response->json();

        // Verificação de campos esperados na resposta
        if (!isset($payment['id']) || !isset($payment['status'])) {
            throw new Exception("API response does not contain expected fields.");
        }

        $this->saveDunning($payment, $business_id, $installments, $installmentValue);
        $this->saveItems($items, $payment);


        return $payment;
    }

    public function createPaymentCreditCrad($request, $installments, $installmentValue, $customerDetails, $business_id, $items)
    {
        if (!$this->apiKey) {
            throw new Exception("API key not set. Please set the business ID using setBusinessId method.");
        }
       /*  dd($request);
        die; */
        $clientIp = $this->getRealIp($request);

        $transaction_date = Carbon::now()->toDateString();
        $url = "{$this->baseUrl}/payments";

        $creditCard = [
            'holderName' => $request->input('holderName'),
            'number' => $request->input('number'),
            'expiryMonth' => $request->input('expiryMonth'),
            'expiryYear' => $request->input('expiryYear'),
            'ccv' => $request->input('ccv'),
        ];

        $creditCardHolderInfo = [
            'name' => $request->input('fullname'),
            'email' => $request->input('email'),
            'cpfCnpj' => $request->input('cpfCnpj'),
            'postalCode' => $request->input('postalCode'),
            'addressNumber' => $request->input('addressNumber'),
            'addressComplement' => $request->input('addressComplement'),
            'phone' => $request->input('phone'),
            'remoteIp'=> $clientIp
        ];

        $body = [
            'customer' => $customerDetails['id'],
            'billingType' => $request->input('billingTypeSelect'),
            'value' => $request->input('total'),
            'installmentCount' => $installments,
            'installmentValue' => $installmentValue,
            'dueDate' => $transaction_date,
            'creditCard' => $creditCard,
            'creditCardHolderInfo' => $creditCardHolderInfo,

        ];

        $response = Http::withHeaders([
            'accept' => 'application/json',
            'access_token' => $this->apiKey,
            'content-type' => 'application/json',
        ])->post($url, $body);

        if ($response->failed()) {
            throw new Exception("Error: " . $response->body());
        }

        $payment = $response->json();

        // Verificação de campos esperados na resposta
        if (!isset($payment['id']) || !isset($payment['status'])) {
            throw new CustomException("API response does not contain expected fields.", 502);
        }

        $this->saveDunning($payment, $business_id, $installments, $installmentValue);
        $this->saveItems($items, $payment);


        return $payment;
    }


    private function getRealIp($request)
    {
        $clientIp = $request->getClientIp();

        // Verificar cabeçalhos comuns que podem conter o IP real do cliente
        if ($request->server('HTTP_X_FORWARDED_FOR')) {
            $clientIp = $request->server('HTTP_X_FORWARDED_FOR');
        } elseif ($request->server('HTTP_CLIENT_IP')) {
            $clientIp = $request->server('HTTP_CLIENT_IP');
        } elseif ($request->server('HTTP_X_REAL_IP')) {
            $clientIp = $request->server('HTTP_X_REAL_IP');
        }

        return $clientIp;
    }

    public function getQrcode($id)
    {

        if (!$this->apiKey) {
            throw new Exception("API key not set. Please set the business ID using setBusinessId method.");
        }

        $url = "{$this->baseUrl}/payments/{$id}/pixQrCode";

        $resp = Http::withHeaders([
            'accept' => 'application/json',
            'access_token' => $this->apiKey,
        ])->get($url);


        if ($resp->failed()) {
            throw new Exception("Error: " . $resp->body());
        }

        $resps= $resp->json();


        // Simulando a resposta da operadora de cobrança
        $response = [
            "success" => true,
            "encodedImage" => $resps['encodedImage'], // Aqui estará a string Base64 do seu QR Code
            "expirationDate" => $resps['expirationDate']
        ];

        return view('checkout.showQrcode', [
            'qrCode' => $response['encodedImage']
        ]);
    }

    public function createCustomer($contact)
    {
        if (!$this->apiKey) {
            throw new Exception("API key not set. Please set the business ID using setBusinessId method.");
        }

        $url = "{$this->baseUrl}/customers";

        $body = [
            'name' => $contact->name,
            'cpfCnpj' => $contact->cpf_cnpj,
            'email' => $contact->email,
            'mobilePhone' => $contact->mobile
        ];

        $response = Http::withHeaders([
            'accept' => 'application/json',
            'access_token' => $this->apiKey,
            'content-type' => 'application/json',
        ])->post($url, $body);

        if ($response->failed()) {
            throw new Exception("Error: " . $response->body());
        }

        $customer = $response->json();

        return $customer;
    }

    private function saveDunning($payment, $business_id, $quantidade_parcelas = null, $valor_parcela = null)
    {
        $number_pedido = $this->generateSequentialPedidoNumber();
        $userID = Auth::id();

        $order_ecommerce = new OrdesEcommerce();
        $order_ecommerce->business_id = $business_id;
        $order_ecommerce->id_dunning_asaas = $payment['id'] ?? null;
        $order_ecommerce->customer_id = $payment['customer'] ?? null;
        $order_ecommerce->billing_type = $payment['billingType'] ?? null;
        $order_ecommerce->date_created = $payment['dateCreated'] ?? null;
        $order_ecommerce->data_vencimento = $payment['dueDate'] ?? null;
        $order_ecommerce->vencimento_original = $payment['originalDueDate'] ?? null;
        $order_ecommerce->status = $payment['status'] ?? null;
        $order_ecommerce->id_parcelamento = $payment['installment'] ?? null;
        $order_ecommerce->numero_parcela = $payment['installmentNumber'] ?? null;
        $order_ecommerce->quantidade_parcela = $quantidade_parcelas ?? null;
        $order_ecommerce->valor_parcela = $valor_parcela ?? null;
        $order_ecommerce->payment_link = $payment['paymentLink'] ?? null;
        $order_ecommerce->pix_transaction = $payment['pixTransaction'] ?? null;
        $order_ecommerce->invoiceNumber = $payment['invoiceNumber'] ?? null;
        $order_ecommerce->pixQrCodeId = $payment['pixQrCodeId'] ?? null;
        $order_ecommerce->valor_before_taxa = $quantidade_parcelas > 0 ? $quantidade_parcelas *  $valor_parcela :  $payment['value'];
        $order_ecommerce->valor_after_taxa =  $quantidade_parcelas > 0 ? $quantidade_parcelas *  $payment['netValue'] :  $payment['netValue'];
        $order_ecommerce->installment_id = $payment['id'] ?? null;
        $order_ecommerce->valor_juro_after_vencimento = $payment['interestValue'] ?? null;
        $order_ecommerce->description = $payment['description'] ?? null;
        $order_ecommerce->invoice_url = $payment['invoiceUrl'] ?? null;
        $order_ecommerce->number_pedido = $number_pedido;
        $order_ecommerce->cliente_id = $userID;
        $order_ecommerce->save();
    }

    private function saveItems($items, $payment)
    {
        foreach ($items as $item) {
            $date = new ProdutosPedidoEcommerce();
            $date->id_pedido = $payment['id'];
            $date->id_produto = $item['id_produto'];
            $date->quantidade = $item['quantity'];
            $date->save();
        }
    }

    public function generateSequentialPedidoNumber()
    {
        $business_id = request()->session()->get('user.business_id');
        $business_details = Business::where('id', $business_id)->first();

        $lastPasswordRecord = DB::table('ordes_ecommerces')->orderBy('number_pedido', 'desc')->first();

        $lastPassword = $lastPasswordRecord ? intval($lastPasswordRecord->number_pedido) : 0;
        $newPassword = str_pad($lastPassword + 1, 4, '0', STR_PAD_LEFT); // Ex: 0001, 0002, etc.

        return $newPassword;
    }
}
