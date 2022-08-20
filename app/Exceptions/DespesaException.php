<?php

namespace App\Exceptions;

use Exception;

class DespesaException extends Exception
{
    public function __construct($message, $code) {
        $this->message = $message;
        $this->code= $code;
    }
}