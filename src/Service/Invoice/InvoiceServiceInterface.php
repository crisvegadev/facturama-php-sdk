<?php declare(strict_types=1);

namespace Crisvegadev\Facturama\Service\Invoice;

use Crisvegadev\Facturama\enums\InvoiceFileTypes;
use Crisvegadev\Facturama\enums\InvoiceStatus;
use Crisvegadev\Facturama\Service\ResponseData;

interface InvoiceServiceInterface
{
    function create(array $data): ResponseData;

    function get(string $id): ResponseData;

    function getAll(InvoiceStatus $type): ResponseData;

    function cancel(string $id, InvoiceStatus $type, string $motive, string $uuidReplacement = null): ResponseData;

    function cancellationAccuse(InvoiceFileTypes $fileType, InvoiceStatus $type, string $id): ResponseData;

    function streamFile(InvoiceFileTypes $fileType, InvoiceStatus $type, string $id): ResponseData;

    static function formatError(object $response): array;

}
