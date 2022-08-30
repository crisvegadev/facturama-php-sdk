<?php declare(strict_types=1);

namespace Crisvegadev\Facturama;

use Crisvegadev\Facturama\enums\InvoiceFileTypes;
use Crisvegadev\Facturama\enums\InvoiceStatus;
use Crisvegadev\Facturama\Service\Invoice\InvoiceService;
use Crisvegadev\Facturama\Service\ResponseData;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class Invoice{

    /**
     * Create a new invoice
     *
     * @param array $data
     *
     * @return ResponseData
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws \ReflectionException
     */
    public static function create(array $data): ResponseData
    {
        return (new Container())->get(InvoiceService::class)->create($data);
    }

    /**
     * Get the invoice requested
     *
     * @param $type = ( payroll | issued )
     * @param $id = id of the invoice
     *
     * @return ResponseData
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws \ReflectionException
     */
    public static function get(string $id, InvoiceStatus $type): ResponseData
    {
        return (new Container())->get(InvoiceService::class)->get($id, $type);
    }

    /**
     * Get all invoices requested
     *
     * @param InvoiceStatus $type = ( payroll | issued )
     * @return ResponseData
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws \ReflectionException
     */
    public static function getAll(InvoiceStatus $type): ResponseData
    {
        return (new Container())->get(InvoiceService::class)->getAll($type);
    }

    /**
     * Cancel an invoice
     *
     * @param string $id = id of the invoice
     *
     * @param InvoiceStatus $type = ( payroll | issued | received )
     * @param string $motive = ( 01 - Comprobante emitido con errores con relación | 02 - Comprobante emitido con errores sin relación | 03 - No se llevó a cabo la operación | 04 - Operación nominativa relacionada con una factura global )
     * @param string|null $uuidReplacement
     * @return ResponseData
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws \ReflectionException
     */
    public static function cancel(string $id, InvoiceStatus $type, string $motive, string $uuidReplacement = null): ResponseData
    {
        return (new Container())->get(InvoiceService::class)->cancel($id, $type, $motive, $uuidReplacement);
    }

    /**
     * return PDF base64 string of cancelled invoice of SAT
     *
     * @param InvoiceFileTypes $format =  ( pdf | html )
     * @param InvoiceStatus $type = ( payroll | issued )
     * @param string $id = id of the invoice
     *
     * @return ResponseData
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws \ReflectionException
     */
    public static function cancellationAccuse(InvoiceFileTypes $format, InvoiceStatus $type, string $id): ResponseData
    {
        return (new Container())->get(InvoiceService::class)->cancellationAccuse($format, $type, $id);
    }

    /**
     * Stream file to browser
     *
     * @param InvoiceFileTypes $fileType =  ( pdf | html, xml )
     * @param InvoiceStatus $type = ( payroll | issued )
     * @param string $id = id of the invoice
     *
     * @return ResponseData
     * @throws ContainerExceptionInterface
     * @throws \ReflectionException
     */
    public static function streamFile(InvoiceFileTypes $fileType, InvoiceStatus $type, string $id): ResponseData
    {
        return (new Container())->get(InvoiceService::class)->streamFile($fileType, $type, $id);
    }

}
