<?php

namespace Crisvegadev\Facturama\Exception;

use Exception;

class ServerException extends Exception {
    public object $response;

    public function __construct(string $message = "", int $code = 0, $previous = null, $response)
    {
        parent::__construct($message, $code, null);
        $this->response = $response;
    }
}
