<?php

namespace Crisvegadev\Facturama;

use Crisvegadev\Facturama\Exception\NotFoundException;
use Crisvegadev\Facturama\Exception\UnauthorizedException;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Storage;

class Invoice{

    public static function create($data): array|string|\stdClass|null
    {
        try {
            return FacturamaClient::getInstance()->post('3/cfdis', $data);
        } catch (UnauthorizedException $e){
            return [
                'error' => "Unauthorized",
                'code' => $e->getCode(),
            ];
        } catch (NotFoundException $e){
            return [
                'error' => "The resource you are looking for could not be found",
                'code' => "404",
            ];
        } catch (GuzzleException $e){
            return [
                'error' => "GuzzleException",
                'code' => $e->getCode(),
            ];
        } catch (Exception $e) {
            return [
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'body' => $e,
            ];
        }
    }

    /**
     * @throws Exception
     */
    public static function downloadFile($fileType, $type, $id) {
        $allowedFileType = ['pdf', 'xml', 'html'];

        if (!in_array($fileType, $allowedFileType)) {
            throw new Exception('El tipo de archivo no es válido');
        }

        $result = FacturamaClient::getInstance()->get('cfdi/'.$fileType.'/'.$type.'/'.$id, []);

        $decoded = base64_decode(end($result));
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

    }

    /**
     * @throws Exception
     *
     * return a decoded base64 string
     */
    public static function streamFile($fileType, $type, $id) {
        $allowedFileType = ['pdf', 'xml', 'html'];

        if (!in_array($fileType, $allowedFileType)) {
            throw new Exception('El tipo de archivo no es válido');
        }

        $result = FacturamaClient::getInstance()->get('cfdi/'.$fileType.'/'.$type.'/'.$id, []);

        return base64_decode($result->data->Content);
    }

    //cancellation acuse

    //cancellation invoice
    public static function cancel($id, $type, $motive, $uuidReplacement = null): array|string|\stdClass|null
    {
        try {
            return FacturamaClient::getInstance()->delete("cfdi/$id?type=$type&motive=$motive&uuidReplacement=$uuidReplacement", []);
        } catch (UnauthorizedException $e){
            return [
                'error' => "Unauthorized",
                'code' => $e->getCode(),
            ];
        } catch (NotFoundException $e){
            return [
                'error' => "The resource you are looking for could not be found",
                'code' => "404",
            ];
        } catch (GuzzleException $e){
            return [
                'error' => "GuzzleException",
                'code' => $e->getCode(),
            ];
        } catch (Exception $e) {
            return [
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'body' => $e,
            ];
        }
    }

    public static function cancellationAccuse($format, $type, $id): array|string|\stdClass|null
    {
        try {
            return FacturamaClient::getInstance()->get("acuse/$format/$type/$id", []);
        } catch (UnauthorizedException $e){
            return [
                'error' => "Unauthorized",
                'code' => $e->getCode(),
            ];
        } catch (NotFoundException $e){
            return [
                'error' => "The resource you are looking for could not be found",
                'code' => "404",
            ];
        } catch (GuzzleException $e){
            return [
                'error' => "GuzzleException",
                'code' => $e->getCode(),
            ];
        } catch (Exception $e) {
            return [
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'body' => $e,
            ];
        }
    }

    //search last 2000 invoices

    public static function get($id, $type = "issued")
    {
        try {
            return  FacturamaClient::getInstance()->get('cfdi/'.$id, ["type" => $type]);
        } catch (UnauthorizedException $e){
            return [
                'error' => "Unauthorized",
                'code' => $e->getCode(),
            ];
        } catch (NotFoundException $e){
            return [
                'error' => "The resource you are looking for could not be found",
                'code' => "404",
            ];
        } catch (GuzzleException $e){
            return [
                'error' => "GuzzleException",
                'code' => $e->getCode(),
            ];
        } catch (Exception $e) {
            return [
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'body' => $e,
            ];
        }
    }

    //send email with concept

    //send email


}
