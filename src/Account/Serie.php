<?php

namespace Crisvegadev\Facturama\Account;

use Crisvegadev\Facturama\Exception\UnauthorizedException;
use Crisvegadev\Facturama\Exception\NotFoundException;
use Crisvegadev\Facturama\FacturamaClient;
use GuzzleHttp\Exception\GuzzleException;
use Exception;

class Serie
{

    /**
     * @throws Exception
     */
    public static function getSeries($idBranchOffice)
    {
        try {
            return FacturamaClient::getInstance()->get('serie/'.$idBranchOffice, []);
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
    public static function searchByName($idBranchOffice, $name)
    {
        try {
            return FacturamaClient::getInstance()->get('serie/'.$idBranchOffice.'/'.$name, []);
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
    public static function update($idBranchOffice, $name, $data)
    {
        try {
            return FacturamaClient::getInstance()->put('serie/'.$idBranchOffice.'/'.$name, $data);
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
    public static function create($idBranchOffice, $data)
    {
        try {
            return FacturamaClient::getInstance()->post('serie/'.$idBranchOffice, $data);
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
    public static function delete($idBranchOffice, $name)
    {
        try {
            return FacturamaClient::getInstance()->delete('serie/'.$idBranchOffice.'/'.$name, []);
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
