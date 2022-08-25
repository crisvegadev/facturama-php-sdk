<?php

namespace Crisvegadev\Facturama\Exception;

use Exception;

class ModelException extends Exception {}

class NotFoundException extends \Exception {}

class ServerException extends \Exception {}

class UnauthorizedException extends \Exception {}

class AppException extends Exception {}

class ResponseException extends \Exception {}

class BadRequestException extends Exception
{
    public object $response;

    public function __construct(string $message = "", int $code = 0, $previous = null, $response)
    {
        parent::__construct($message, $code, null);
        $this->response = $response;
    }
}
