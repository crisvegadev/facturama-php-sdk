<?php declare(strict_types=1);

namespace Crisvegadev\Facturama\Service\Invoice;

use Crisvegadev\Facturama\enums\InvoiceFileTypes;
use Crisvegadev\Facturama\enums\InvoiceStatus;
use Crisvegadev\Facturama\Service\ResponseData;

interface InvoiceServiceInterface
{
    function create(array $data): ResponseData;

    function get(string $id): ResponseData;

    function getAll(string $type): ResponseData;

    function cancel(string $id, string $type, string $motive, string $uuidReplacement = null): ResponseData;

    function cancellationAccuse(string $fileType, string $type, string $id): ResponseData;

    function streamFile(string $fileType, string $type, string $id): ResponseData;

    static function formatError(object $response): array;

}
