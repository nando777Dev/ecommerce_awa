<?php

namespace App\Services;

use App\Models\Contact;

class CustomerService
{


    //Adiciona o customer na Asaas caso nao esteja cadastrado
   /* public function addCustomerInAssas($contact): array
    {

        $data = [
            'name'=> $contact->name,
            'cpfCnpj'=>$contact->cpf_cnpj,
            'email'=>$contact->email,
            'mobilePhone'=>$contact->mobile
        ];

        $customerCreate = (new \App\Services\AsaasPhp\Customer\CustomerCreate(data: $data))->handle();

        $contact = Contact::find($contact->id);
        $contact->update(['customer_id' => $customerCreate['id']]);

        return $customerCreate;

    }*/

    public function createCustomer($contact)
    {
        $url = "{$this->baseUrl}/customers";

        $body = [
            'name'=> $contact->name,
            'cpfCnpj'=>$contact->cpf_cnpj,
            'email'=>$contact->email,
            'mobilePhone'=>$contact->mobile
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

        // Verificação de campos esperados na resposta
        if (!isset($payment['id']) || !isset($payment['status'])) {
            throw new Exception("API response does not contain expected fields.");
        }

        return $customer;
    }


    // Recupera os dados do customer na Asaas
    public function getCustomer($customerID): array
    {
        $customer = (new \App\Services\AsaasPhp\Customer\CustomerSpecific(data: ['id' => $customerID]))->handle();

        return $customer;
    }

}
