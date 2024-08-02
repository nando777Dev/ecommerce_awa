<?php

namespace App\Services;

use App\Models\Business;
use App\Models\BusinessLocation;
use App\Models\OrdesEcommerce;
use App\Models\ProdutosPedidoEcommerce;
use App\Models\Transaction;
use App\Models\TransactionSellLine;
use App\Models\Variation;
use App\Services\AsaasPhp\Payment\PaymentList;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionService
{


    public function postDunning($input, $installments, $installmentValue, $customerDetails, $business_id, $items): array
    {


        $transaction_date = Carbon::now()->toDateString();
        /*dd($installments, $installmentValue, $transaction_date, $input);
        die;*/
        $data =  [
            'customer'=>$customerDetails['id'],
            'billingType'=>$input['billingTypeSelect'],
            'value'=>$input['total'],
            'installmentCount' => $installments,
            'installmentValue'=>$installmentValue,
            'dueDate'=>$transaction_date
        ];
        try {
            // Tenta realizar o pagamento
            $payment = (new PaymentList(data: $data))->handle();

            $this->saveDunning($payment, $business_id, $installments, $installmentValue );

            $this->saveIntems($items, $payment);

            return $payment;
        } catch (\Exception $e) {

            return [
                'error' => 'Payment processing error: ' . $e->getMessage()
            ];
        }
    }

    private function saveDunning($payment, $business_id, $quantidade_parcelas = null, $valor_parcela = null )
    {
        $number_pedido = $this->generateSequentialPedidoNumber();
        $userID = Auth::id();

        $order_ecommerce  = new OrdesEcommerce();
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

    private function saveIntems($items, $payment)
    {
        foreach ($items as $iten){
            $date = new ProdutosPedidoEcommerce();
            $date->id_pedido = $payment['id'];
            $date->id_produto = $iten['id_produto'];
            $date->quantidade = $iten['quantity'];
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
