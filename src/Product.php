<?php

namespace Crisvegadev\Facturama;

use Crisvegadev\Facturama\Exception\UnauthorizedException;
use Crisvegadev\Facturama\Exception\NotFoundException;
use GuzzleHttp\Exception\GuzzleException;
use Exception;
use stdClass;

class Product
{
    /**
     * @throws Exception
     */
    public static function getAll(): array|string|stdClass|null
    {
        try {
            return FacturamaClient::getInstance()->get('Product', []);
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

    public static function get(string $id){
        try {
            return FacturamaClient::getInstance()->get('Product/'.$id, []);
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
            return FacturamaClient::getInstance()->get('Products', [
                "keyword" => $keyword
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

    public static function create(array $data){
        try {
            return FacturamaClient::getInstance()->post('Product/', $data);
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
            return FacturamaClient::getInstance()->delete('Product/'.$id);
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
