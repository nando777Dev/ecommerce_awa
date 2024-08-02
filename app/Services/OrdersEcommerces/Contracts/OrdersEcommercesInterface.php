<?php

namespace App\Services\OrdersEcommerces\Contracts;

interface OrdersEcommercesInterface
{

    //Create pedido
    public function create(): array;

    public function list() : array;
}
