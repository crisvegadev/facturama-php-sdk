<?php

namespace Crisvegadev\Facturama;

use Crisvegadev\Facturama\Exception\UnauthorizedException;
use Crisvegadev\Facturama\Exception\BadRequestException;
use Crisvegadev\Facturama\Exception\NotFoundException;
use Crisvegadev\Facturama\Exception\ServerException;
use GuzzleHttp\Exception\GuzzleException;
use Exception;

class Invoice {

    static $facturamaClient;

    public function __construct(FacturamaClient $facturamaClient = null){
        self::$facturamaClient = $facturamaClient;
    }

    /**
     * Create a new invoice
     *
     * @param array $data
     *
     * @return object
     *
     * @throws Exception
     * @throws GuzzleException
     */
    public static function create(array $data): object
    {
        try {

            if (empty($data)) {
                throw new Exception('No data provided');
            }

            return FacturamaClient::getInstance()->post('3/cfdis', $data);

        } catch (UnauthorizedException $e) {

            return (object) [
                'statusCode' => 401,
                'statusMessage' => 'Unauthorized',
                'message' => $e->getMessage(),
                'data' => [],
                'errors' => []
            ];

        } catch (NotFoundException $e) {

            return (object) [
                'statusCode' => 404,
                'statusMessage' => 'Not Found',
                'message' => $e->getMessage(),
                'data' => [],
                'errors' => []
            ];

        } catch (ServerException $e) {

            return (object) [
                'statusCode' => 500,
                'statusMessage' => 'Server Error',
                'message' => $e->getMessage(),
                'data' => [],
                'errors' => self::formatError($e->response)
            ];

        } catch (BadRequestException $e){

            return (object) [
                'statusCode' => 400,
                'statusMessage' => 'Invalid Request',
                'message' => $e->getMessage(),
                'data' => [],
                'errors' => self::formatError($e->response)
            ];


        } catch (Exception $e) {

            return (object) [
                'statusCode' => 0,
                'statusMessage' => 'App Error',
                'message' => $e->getMessage(),
                'data' => [],
                'errors' => []
            ];

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
    private static function formatError(object $response): array
    {
        $errors = [];

        if (property_exists($response, 'ModelState')) {

            foreach ($response->ModelState as $key => $value) {
                $errors[$key] = $value[0];
            }
        } else  if (property_exists($response, 'Message')) {
            $errors['message'] = $response->Message;
        } else {
            $errors['message'] = 'An error occurred';
        }

        return $errors;
    }

    /**
     * Return a download of the invoice
     *
     * @param string $fileType =  ( pdf | html, xml )
     * @param string $type = ( payroll | issued )
     * @param string $id = id of the invoice
     *
     * @throws Exception
     * @throws GuzzleException
     */
    public static function downloadFile(string $fileType, string $type, string $id)
    {
        try {
            $allowedFileType = ['pdf', 'xml', 'html'];

            if (!in_array($fileType, $allowedFileType)) {
                throw new Exception('El tipo de archivo no es válido');
            }

            $result = FacturamaClient::getInstance()->get('cfdi/'.$fileType.'/'.$type.'/'.$id, []);


            $decoded = base64_decode($result->data->Content);
            $file = 'invoice.pdf';
            file_put_contents($file, $decoded);

            if (file_exists($file)) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="'.basename($file).'"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($file));
                readfile($file);
                exit;
            }

        } catch (Exception $e) {

            return (object) [
                'statusCode' => 0,
                'statusMessage' => 'App Error',
                'message' => $e->getMessage(),
                'data' => [],
                'errors' => []
            ];

        }

    }

    /**
     * Stream file to browser
     *
     * @param string $fileType =  ( pdf | html, xml )
     * @param string $type = ( payroll | issued )
     * @param string $id = id of the invoice
     *
     * @return string
     *
     * @throws Exception
     * @throws GuzzleException
     */
    public static function streamFile(string $fileType, string $type, string $id): string
    {
        try {
            $allowedFileType = ['pdf', 'xml', 'html'];

            if (!in_array($fileType, $allowedFileType)) {
                throw new Exception('El tipo de archivo no es válido');
            }

            $result = FacturamaClient::getInstance()->get('cfdi/'.$fileType.'/'.$type.'/'.$id, []);

            return base64_decode($result->data->Content);
        } catch (Exception $e) {

            return (object) [
                'statusCode' => 0,
                'statusMessage' => 'App Error',
                'message' => $e->getMessage(),
                'data' => [],
                'errors' => []
            ];

        }
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
     * @throws Exception
     * @throws GuzzleException
     */
    public static function cancel(string $id, string $type, string $motive, string $uuidReplacement = null): object
    {
        try {

            return FacturamaClient::getInstance()->delete("cfdi/$id?type=$type&motive=$motive&uuidReplacement=$uuidReplacement", []);

        } catch (UnauthorizedException $e) {

            return (object) [
                'statusCode' => 401,
                'statusMessage' => 'Unauthorized',
                'message' => $e->getMessage(),
                'data' => [],
                'errors' => []
            ];

        } catch (NotFoundException $e) {

            return (object) [
                'statusCode' => 404,
                'statusMessage' => 'Not Found',
                'message' => $e->getMessage(),
                'data' => [],
                'errors' => []
            ];

        } catch (ServerException $e) {

            return (object) [
                'statusCode' => 500,
                'statusMessage' => 'Server Error',
                'message' => $e->getMessage(),
                'data' => [],
                'errors' => []
            ];

        } catch (BadRequestException $e){

            return (object) [
                'statusCode' => 400,
                'statusMessage' => 'Invalid Request',
                'message' => $e->getMessage(),
                'data' => [],
                'errors' => self::formatError($e->response)
            ];


        } catch (Exception $e) {

            return (object) [
                'statusCode' => 0,
                'statusMessage' => 'App Error',
                'message' => $e->getMessage(),
                'data' => [],
                'errors' => []
            ];

        }
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
     * @throws Exception
     * @throws GuzzleException
     */
    public static function cancellationAccuse(string $format, string $type, string $id): object
    {
        try {

            return FacturamaClient::getInstance()->get("acuse/$format/$type/$id", []);

        } catch (UnauthorizedException $e) {

            return (object) [
                'statusCode' => 401,
                'statusMessage' => 'Unauthorized',
                'message' => $e->getMessage(),
                'data' => [],
                'errors' => []
            ];

        } catch (NotFoundException $e) {

            return (object) [
                'statusCode' => 404,
                'statusMessage' => 'Not Found',
                'message' => $e->getMessage(),
                'data' => [],
                'errors' => []
            ];

        } catch (ServerException $e) {

            return (object) [
                'statusCode' => 500,
                'statusMessage' => 'Server Error',
                'message' => $e->getMessage(),
                'data' => [],
                'errors' => []
            ];

        } catch (BadRequestException $e){

            return (object) [
                'statusCode' => 400,
                'statusMessage' => 'Invalid Request',
                'message' => $e->getMessage(),
                'data' => [],
                'errors' => self::formatError($e->response)
            ];


        } catch (Exception $e) {

            return (object) [
                'statusCode' => 0,
                'statusMessage' => 'App Error',
                'message' => $e->getMessage(),
                'data' => [],
                'errors' => []
            ];

        }
    }

    /**
     * Get the invoice requested
     *
     * @param $type = ( payroll | issued )
     * @param $id = id of the invoice
     *
     * @return object
     *
     * @throws Exception
     * @throws GuzzleException
     */
    public static function get(string $id, string $type = "issued"): object
    {
        try {

            return FacturamaClient::getInstance()->get('cfdi/'.$id, ["type" => $type]);

        } catch (UnauthorizedException $e) {

            return (object) [
                'statusCode' => 401,
                'statusMessage' => 'Unauthorized',
                'message' => $e->getMessage(),
                'data' => [],
                'errors' => []
            ];

        } catch (NotFoundException $e) {

            return (object) [
                'statusCode' => 404,
                'statusMessage' => 'Not Found',
                'message' => $e->getMessage(),
                'data' => [],
                'errors' => []
            ];

        } catch (ServerException $e) {

            return (object) [
                'statusCode' => 500,
                'statusMessage' => 'Server Error',
                'message' => $e->getMessage(),
                'data' => [],
                'errors' => []
            ];

        } catch (BadRequestException $e){

            return (object) [
                'statusCode' => 400,
                'statusMessage' => 'Invalid Request',
                'message' => $e->getMessage(),
                'data' => [],
                'errors' => self::formatError($e->response)
            ];


        } catch (Exception $e) {

            return (object) [
                'statusCode' => 0,
                'statusMessage' => 'App Error',
                'message' => $e->getMessage(),
                'data' => [],
                'errors' => []
            ];

        }
    }



}
