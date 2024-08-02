<?php

namespace App\Exceptions;

use Exception;

class CustomException extends Exception
{
    protected $code;

    public function __construct($message = "Custom Exception Occurred", $code = 0)
    {
        parent::__construct($message, $code);
        $this->code = $code;
    }

    public function render($request)
    {
        // Determine the error message based on the error code
        $errorMessage = $this->getMessageForCode($this->code);

        // Pass the message and code to the custom error view
        return response()->view('errors.custom', ['exception' => $this, 'message' => $errorMessage, 'code' => $this->code], 500);
    }

    // A method to get custom messages based on the error code
    protected function getMessageForCode($code)
    {
        switch ($code) {
            case 404:
                return "Resource not found.";
            case 403:
                return "Access denied.";
            case 502:
                    return "Erro no processo de pagamento";
            case 402:
                        return "Produto nao encontrado";
            case 500:
            default:
                return "An internal server error occurred.";
        }
    }
}
