<?php

namespace Crisvegadev\Facturama\Exception;

use Exception;
use Throwable;

class BadRequestException extends Exception
{
    public object $response;

    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null, object $response = null)
    {
        parent::__construct($message, $code, $previous);
        $this->response = $response;
    }

}
