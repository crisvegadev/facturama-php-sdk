<?php declare(strict_types=1);

namespace Crisvegadev\Facturama\Service\Invoice;

use Crisvegadev\Facturama\Service\ResponseData;
use Exception;

interface InvoiceServiceInterface
{
    /**
     * Create a new invoice
     *
     * @param array $data
     *
     * @return ResponseData
     *
     * @throws Exception
     */
    function create(array $data): ResponseData;

    /**
     * Get the invoice requested
     *
     * @param string $type = ( payroll | issued )
     * @param string $id = id of the invoice
     *
     * @return ResponseData
     *
     * @throws Exception
     */
    function get(string $id, string $type): ResponseData;

    /**
     * Get the invoice requested
     *
     * @param string $type = ( payroll | issued )
     *
     * @return ResponseData
     *
     * @throws Exception
     */
    function getAll(string $type): ResponseData;

    /**
     * Cancel an invoice
     *
     * @param string $id = id of the invoice
     *
     * @param string $type = ( payroll | issued | received )
     * @param string $motive = ( 01 - Comprobante emitido con errores con relación | 02 - Comprobante emitido con errores sin relación | 03 - No se llevó a cabo la operación | 04 - Operación nominativa relacionada con una factura global )
     * @param string|null $uuidReplacement
     * @return ResponseData
     *
     * @throws Exception
     */
    function cancel(string $id, string $type, string $motive, string $uuidReplacement = null): ResponseData;

    /**
     * return PDF base64 string of cancelled invoice of SAT
     *
     * @param string $fileType =  ( pdf | html )
     * @param string $type = ( payroll | issued )
     * @param string $id = id of the invoice
     *
     * @return ResponseData
     *
     * @throws Exception
     */
    function cancellationAccuse(string $fileType, string $type, string $id): ResponseData;

    /**
     * Stream file to browser
     *
     * @param string $fileType =  ( pdf | html, xml )
     * @param string $type = ( payroll | issued )
     * @param string $id = id of the invoice
     *
     * @return ResponseData
     *
     * @throws Exception
     */
    function streamFile(string $fileType, string $type, string $id): ResponseData;

    /**
     * Create a new invoice
     *
     * @param object $response
     *
     * @return array
     *
     * @throws Exception
     */
    static function formatError(object $response): array;

}
