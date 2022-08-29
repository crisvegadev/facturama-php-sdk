<?php declare(strict_types=1);

namespace Crisvegadev\Facturama\Service;

interface InvoiceServiceInterface
{
    function create(array $data): object;

    function get(string $id): object;

    function getAll(string $type): object;

    function cancel(string $id, string $type, string $motive, string $uuidReplacement = null): object;

    function cancellationAccuse(string $format, string $type, string $id): object;

    function streamFile(string $fileType, string $type, string $id): object;

    static function formatError(object $response): array;

}
