<?php

use App\Services\AsaasPhp\Payment\PaymentList;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;


/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('play', function () {

    $data =  [
        'customer'=>'cus_000006068050',
        'billingType'=>'CREDIT_CARD',
        'value'=>'250.000',
        'dueDate'=>'2024-06-29'
        ];

    $payment = (new PaymentList(data: $data))->handle();
    //$customers = (new \App\Services\AsaasPhp\Customer\CustomerCreate(data: $data))->handle();

   dd($payment);

});
