<?php

namespace Crisvegadev\Facturama;

use Crisvegadev\Facturama\Exception\UnauthorizedException;
use Crisvegadev\Facturama\Exception\NotFoundException;
use GuzzleHttp\Exception\GuzzleException;
use Exception;
use stdClass;

class Customer
{

    /**
     * @throws Exception
     */
    public static function getAll(): array|string|stdClass|null
    {
        try {
            return FacturamaClient::getInstance()->get('client', []);
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

    public static function search(string $keyword){
        try {
            return FacturamaClient::getInstance()->get('client', [
                'keyword' => $keyword
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
     * Get a customer by id
     *
     * @param string $id
     * @throws Exception
     */
    public static function getById($id): array|string|stdClass|null
    {
        try {
            return FacturamaClient::getInstance()->get('client/' . $id, []);
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

    public static function create($params)
    {
        try {
            return FacturamaClient::getInstance()->post('client', $params);
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

    public static function delete(string $id){
        try {
            return FacturamaClient::getInstance()->delete('client/' . $id, []);
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

    public static function rfcStatus($rfc){
        try {
            return FacturamaClient::getInstance()->get('customers/status' , [
                "rfc" => $rfc
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



}
