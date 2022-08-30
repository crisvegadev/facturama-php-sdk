<?php declare(strict_types=1);

namespace Crisvegadev\Facturama\Service\Invoice;

use Crisvegadev\Facturama\client\FacturamaClient;
use Crisvegadev\Facturama\enums\InvoiceFileTypes;
use Crisvegadev\Facturama\enums\InvoiceStatus;
use Crisvegadev\Facturama\Exception\BadRequestException;
use Crisvegadev\Facturama\Exception\NotFoundException;
use Crisvegadev\Facturama\Exception\ServerException;
use Crisvegadev\Facturama\Exception\UnauthorizedException;
use Crisvegadev\Facturama\Service\ResponseData;
use GuzzleHttp\Exception\GuzzleException;
use Exception;


class InvoiceService implements InvoiceServiceInterface
{

    public function __construct(protected FacturamaClient $client){}

    /**
     * Create a new invoice
     *
     * @param array $data
     *
     * @return ResponseData
     *
     * @throws Exception
     * @throws GuzzleException
     */
    public function create(array $data): ResponseData
    {
        try {

            if (empty($data)) {
                throw new Exception('No data provided');
            }

            return ResponseData::fromArray($this->client->post('/invoices', $data));

        } catch (NotFoundException $e) {

            return new ResponseData(
                404,
                'Not Found',
                $e->getMessage(),
                [],
                []
            );


        } catch (ServerException $e) {

            return new ResponseData(
                500,
                'Server Error',
                $e->getMessage(),
                [],
                self::formatError($e->response)
            );


        } catch (BadRequestException $e){

            return new ResponseData(
                400,
                'Invalid Request',
                $e->getMessage(),
                [],
                self::formatError($e->response)
            );


        } catch (Exception $e) {

            return new ResponseData(
                0,
                'App Error',
                $e->getMessage(),
                [],
                []
            );

        }
    }

    /**
     * Get the invoice requested
     *
     * @param InvoiceStatus $type = ( payroll | issued )
     * @param string $id = id of the invoice
     *
     * @return ResponseData
     *
     * @throws Exception
     * @throws GuzzleException
     */
    public function get(string $id, InvoiceStatus $type = InvoiceStatus::Issued): ResponseData
    {
        try {


            return ResponseData::fromArray($this->client->get('cfdi/'.$id, ["type" => $type->toString()]));

        } catch (UnauthorizedException $e) {

            return new ResponseData(
                401,
                'Unauthorized',
                $e->getMessage(),
                [],
                []
            );

        } catch (NotFoundException $e) {

            return new ResponseData(
                404,
                'Not Found',
                $e->getMessage(),
                [],
                []
            );


        } catch (ServerException $e) {

            return new ResponseData(
                500,
                'Server Error',
                $e->getMessage(),
                [],
                self::formatError($e->response)
            );


        } catch (BadRequestException $e){

            return new ResponseData(
                400,
                'Invalid Request',
                $e->getMessage(),
                [],
                self::formatError($e->response)
            );


        } catch (Exception $e) {

            return new ResponseData(
                0,
                'App Error',
                $e->getMessage(),
                [],
                []
            );

        }
    }

    /**
     * Get the invoice requested
     *
     * @param InvoiceStatus $type = ( payroll | issued )
     *
     * @return ResponseData
     *
     * @throws Exception
     * @throws GuzzleException
     */
    public function getAll(InvoiceStatus $type): ResponseData
    {
        try {

            return ResponseData::fromArray($this->client->get('cfdi/', ["type" => $type->toString()]));

        } catch (UnauthorizedException $e) {

            return new ResponseData(
                401,
                'Unauthorized',
                $e->getMessage(),
                [],
                []
            );

        } catch (NotFoundException $e) {

            return new ResponseData(
                404,
                'Not Found',
                $e->getMessage(),
                [],
                []
            );


        } catch (ServerException $e) {

            return new ResponseData(
                500,
                'Server Error',
                $e->getMessage(),
                [],
                self::formatError($e->response)
            );


        } catch (BadRequestException $e){

            return new ResponseData(
                400,
                'Invalid Request',
                $e->getMessage(),
                [],
                self::formatError($e->response)
            );


        } catch (Exception $e) {

            return new ResponseData(
                0,
                'App Error',
                $e->getMessage(),
                [],
                []
            );

        }
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
     * @throws Exception
     * @throws GuzzleException
     */
    public function cancel(string $id, InvoiceStatus $type, string $motive, string $uuidReplacement = null): ResponseData
    {
        try {

            return ResponseData::fromArray($this->client->delete("cfdi/$id?type=$type->value&motive=$motive&uuidReplacement=$uuidReplacement", []));

        } catch (UnauthorizedException $e) {

            return new ResponseData(
                401,
                'Unauthorized',
                $e->getMessage(),
                [],
                []
            );

        } catch (NotFoundException $e) {

            return new ResponseData(
                404,
                'Not Found',
                $e->getMessage(),
                [],
                []
            );


        } catch (ServerException $e) {

            return new ResponseData(
                500,
                'Server Error',
                $e->getMessage(),
                [],
                self::formatError($e->response)
            );


        } catch (BadRequestException $e){

            return new ResponseData(
                400,
                'Invalid Request',
                $e->getMessage(),
                [],
                self::formatError($e->response)
            );


        } catch (Exception $e) {

            return new ResponseData(
                0,
                'App Error',
                $e->getMessage(),
                [],
                []
            );

        }
    }

    /**
     * return PDF base64 string of cancelled invoice of SAT
     *
     * @param InvoiceFileTypes $fileType =  ( pdf | html )
     * @param InvoiceStatus $type = ( payroll | issued )
     * @param string $id = id of the invoice
     *
     * @return ResponseData
     *
     * @throws Exception
     * @throws GuzzleException
     */
    public function cancellationAccuse(InvoiceFileTypes $fileType, InvoiceStatus $type, string $id): ResponseData
    {
        try {

            return ResponseData::fromArray($this->client->get("acuse/$fileType->value/$type->value/$id", []));

        } catch (UnauthorizedException $e) {

            return new ResponseData(
                401,
                'Unauthorized',
                $e->getMessage(),
                [],
                []
            );

        } catch (NotFoundException $e) {

            return new ResponseData(
                404,
                'Not Found',
                $e->getMessage(),
                [],
                []
            );


        } catch (ServerException $e) {

            return new ResponseData(
                500,
                'Server Error',
                $e->getMessage(),
                [],
                self::formatError($e->response)
            );


        } catch (BadRequestException $e){

            return new ResponseData(
                400,
                'Invalid Request',
                $e->getMessage(),
                [],
                self::formatError($e->response)
            );


        } catch (Exception $e) {

            return new ResponseData(
                0,
                'App Error',
                $e->getMessage(),
                [],
                []
            );

        }
    }

    /**
     * Stream file to browser
     *
     * @param InvoiceFileTypes $fileType =  ( pdf | html, xml )
     * @param InvoiceStatus $type = ( payroll | issued )
     * @param string $id = id of the invoice
     *
     * @return ResponseData
     *
     * @throws Exception
     * @throws GuzzleException
     */
    public function streamFile(InvoiceFileTypes $fileType, InvoiceStatus $type, string $id): ResponseData
    {
        try {
            $allowedFileType = ['pdf', 'xml', 'html'];

            if (!in_array($fileType->toString(), $allowedFileType)) {
                throw new Exception('El tipo de archivo no es válido');
            }

            return ResponseData::fromArray($this->client->get('cfdi/'.$fileType->toString().'/'.$type->toString().'/'.$id, []));

        } catch (UnauthorizedException $e) {

            return new ResponseData(
                401,
                'Unauthorized',
                $e->getMessage(),
                [],
                []
            );

        } catch (NotFoundException $e) {

            return new ResponseData(
                404,
                'Not Found',
                $e->getMessage(),
                [],
                []
            );


        } catch (ServerException $e) {

            return new ResponseData(
                500,
                'Server Error',
                $e->getMessage(),
                [],
                self::formatError($e->response)
            );


        } catch (BadRequestException $e){

            return new ResponseData(
                400,
                'Invalid Request',
                $e->getMessage(),
                [],
                self::formatError($e->response)
            );


        } catch (Exception $e) {

            return new ResponseData(
                0,
                'App Error',
                $e->getMessage(),
                [],
                []
            );

        }
    }


    /**
     * Create a new invoice
     *
     * @param object $response
     *
     * @return array
     *
     * @throws Exception
     */
     static function formatError(object $response): array
    {
        $errors = [];

        if (property_exists($response, 'ModelState')) {

            foreach ($response->ModelState as $key => $value) {
                $errors[$key] = $value[0];
            }

        } else  if (property_exists($response, 'Message')) {
            $errors['error.general'] = $response->Message;
        } else {
            $errors['error.general'] = 'An error occurred';
        }

        return $errors;
    }
}
