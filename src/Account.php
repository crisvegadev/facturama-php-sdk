<?php

namespace Crisvegadev\Facturama;

use Crisvegadev\Facturama\Exception\UnauthorizedException;
use Crisvegadev\Facturama\Exception\NotFoundException;
use GuzzleHttp\Exception\GuzzleException;
use Exception;
use stdClass;

class Account
{
    /**
     * @throws Exception
     */
    public static function getUserInfo(): array|string|stdClass|null
    {
        try {
            return FacturamaClient::getInstance()->get('account/UserInfo', []);
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
    public static function uploadLogo($imageBase64, $type = null)
    {
        try {
            return FacturamaClient::getInstance()->put('TaxEntity/UploadLogo', [
                "Image" => $imageBase64,
                "Type" => $type,
            ]);
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
    public static function uploadCSD($certificateFile, $privateKeyFile, $privateKeyPassword)
    {
        try {
            return FacturamaClient::getInstance()->put('TaxEntity/UploadCsd', [
                "Certificate" => $certificateFile,
                "PrivateKey" => $privateKeyFile,
                "PrivateKeyPassword" => $privateKeyPassword,
            ]);
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
    public static function getTaxEntity(): array|string|stdClass|null
    {
        try {
            return FacturamaClient::getInstance()->get('TaxEntity', []);
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
    public static function updateTaxEntity($data)
    {
        try {
            return FacturamaClient::getInstance()->put('TaxEntity', $data);
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
    public static function getSuscriptionPlan()
    {
        try {
            return FacturamaClient::getInstance()->get('SuscriptionPlan', []);
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

}
