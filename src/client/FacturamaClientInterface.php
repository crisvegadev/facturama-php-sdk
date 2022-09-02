<?php declare(strict_types=1);

namespace Crisvegadev\Facturama\client;

interface FacturamaClientInterface
{

    public function get(string $url, array $params = []): array;

    public function post(string $url, array $params = []): array;

    public function put(string $url, array $params = []): array;

    public function delete(string $url, array $params = []): array;

    public function executeRequest(string $method, string $url, array $options = []): array;

}
