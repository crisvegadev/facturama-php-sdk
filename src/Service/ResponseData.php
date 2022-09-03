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

    /**
     * @return int
     */
    public function getStatusCode(): int {
        return $this->statusCode;
    }

    /**
     * @return string
     */
    public function getStatusMessage(): string {
        return $this->statusMessage;
    }

    /**
     * @return string
     */
    public function getMessage(): string {
        return $this->message;
    }

    /**
     * @return mixed
     */
    public function getData(): mixed {
        return $this->data;
    }

    /**
     * @return array
     */
    public function getErrors(): array {
        return $this->errors;
    }

    /**
     * return string
     */
    public function toString(): string {
        return json_encode($this);
    }

    /**
     * @return array
     */
    public function toArray(): array {
        return [
            'statusCode' => $this->statusCode,
            'statusMessage' => $this->statusMessage,
            'message' => $this->message,
            'data' => $this->data,
            'errors' => $this->errors,
        ];
    }

    /**
     * @return string|false
     */
    public function toJson(): string|false {
        return json_encode($this->toArray());
    }

    /**
     * @param array $array
     * @return ResponseData
     */
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

