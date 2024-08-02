<?php

namespace App\Services\AsaasPhp\Payment;

use App\Services\AsaasPhp\Concerns\AsaasClient;
use App\Services\AsaasPhp\Contracts\AsaasPaymentInterface;
use Illuminate\Support\Facades\Http;

class PaymentList implements AsaasPaymentInterface
{
    use AsaasClient;
    public function handle() : array
    {

        try{

            return Http::withHeader('access_token', $this->token)
                ->post("{$this->url}/payments", $this->data)
                ->throw()
                ->json();

        } catch(\Exception $exception){

            return ['error'=> $exception->getMessage()];
        }
    }
}
