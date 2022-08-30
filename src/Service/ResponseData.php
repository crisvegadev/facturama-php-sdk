<?php declare(strict_types=1);

namespace Crisvegadev\Facturama\Service;

class ResponseData {
    public int $statusCode;
    public string $statusMessage;
    public string $message;
    public mixed $data;
    public array $errors;

    public function __construct(int $statusCode, string $statusMessage, string $message, mixed $data, array $errors) {
        $this->statusCode = $statusCode;
        $this->statusMessage = $statusMessage;
        $this->message = $message;
        $this->data = $data;
        $this->errors = $errors;
    }

    public function getStatusCode(): int {
        return $this->statusCode;
    }

    public function getStatusMessage(): string {
        return $this->statusMessage;
    }

    public function getMessage(): string {
        return $this->message;
    }

    public function getData(): array {
        return $this->data;
    }

    public function getErrors(): array {
        return $this->errors;
    }

    public function toString(): string {
        return json_encode($this);
    }

    public function toArray(): array {
        return [
            'statusCode' => $this->statusCode,
            'statusMessage' => $this->statusMessage,
            'message' => $this->message,
            'data' => $this->data,
            'errors' => $this->errors,
        ];
    }

    public function toJson(): string {
        return json_encode($this->toArray());
    }

    public static function fromArray(array $array): ResponseData {
        return new ResponseData(
            $array['statusCode'],
            $array['statusMessage'],
            $array['message'],
            $array['data'],
            $array['errors']
        );
    }

}

