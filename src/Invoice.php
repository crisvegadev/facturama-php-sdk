<?php declare(strict_types=1);

namespace Crisvegadev\Facturama;

use Crisvegadev\Facturama\Service\InvoiceService;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class Invoice{

    /**
     * Create a new invoice
     *
     * @param array $data
     *
     * @return object
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function create(array $data): object
    {
        return (new Container())->get(InvoiceService::class)->create($data);
    }

    /**
     * Get the invoice requested
     *
     * @param $type = ( payroll | issued )
     * @param $id = id of the invoice
     *
     * @return object
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function get($id, $type): object
    {
        return (new Container())->get(InvoiceService::class)->get($id, $type);
    }

    /**
     * Get all invoices requested
     *
     * @param $type = ( payroll | issued )
     * @param $id = id of the invoice
     *
     * @return object
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function getAll($type): object
    {
        return (new Container())->get(InvoiceService::class)->getAll($type);
    }

    /**
     * Cancel an invoice
     *
     * @param string $id = id of the invoice
     *
     * @param string $type = ( payroll | issued | received )
     * @param string $motive = ( 01 - Comprobante emitido con errores con relación | 02 - Comprobante emitido con errores sin relación | 03 - No se llevó a cabo la operación | 04 - Operación nominativa relacionada con una factura global )
     * @param string|null $uuidReplacement
     * @return object
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function cancel(string $id, string $type, string $motive, string $uuidReplacement = null): object
    {
        return (new Container())->get(InvoiceService::class)->cancel($id, $type, $motive, $uuidReplacement);
    }

    /**
     * return PDF base64 string of cancelled invoice of SAT
     *
     * @param string $format =  ( pdf | html )
     * @param string $type = ( payroll | issued )
     * @param string $id = id of the invoice
     *
     * @return object
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function cancellationAccuse(string $format, string $type, string $id): object
    {
        return (new Container())->get(InvoiceService::class)->cancellationAccuse($format, $type, $id);
    }

    /**
     * Stream file to browser
     *
     * @param string $fileType =  ( pdf | html, xml )
     * @param string $type = ( payroll | issued )
     * @param string $id = id of the invoice
     *
     * @return object
     *
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function streamFile(string $fileType, string $type, string $id): object
    {
        return (new Container())->get(InvoiceService::class)->streamFile($fileType, $type, $id);
    }

}
