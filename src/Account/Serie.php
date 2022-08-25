<?php

namespace Crisvegadev\Facturama\Account;

use Crisvegadev\Facturama\Exception\UnauthorizedException;
use Crisvegadev\Facturama\Exception\BadRequestException;
use Crisvegadev\Facturama\Exception\NotFoundException;
use Crisvegadev\Facturama\Exception\ServerException;
use Crisvegadev\Facturama\FacturamaClient;
use GuzzleHttp\Exception\GuzzleException;
use Exception;

class Serie
{

    /**
     * Get Series
     *
     * @param string $idBranchOffice
     *
     * @return object
     *
     * @throws Exception
     * @throws GuzzleException
     */
    public static function getSeries(string $idBranchOffice): object
    {
        try {

            return FacturamaClient::getInstance()->get('serie/'.$idBranchOffice, []);

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
     * Search Series by name
     *
     * @param string $idBranchOffice
     * @param string $name
     *
     * @return object
     *
     * @throws Exception
     * @throws GuzzleException
     */
    public static function searchByName(string $idBranchOffice, string $name): object
    {
        try {
            return FacturamaClient::getInstance()->get('serie/'.$idBranchOffice.'/'.$name, []);
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
     * Update Serie
     *
     * @param string $idBranchOffice
     * @param string $name
     * @param array $data
     *
     * @return object
     *
     * @throws Exception
     * @throws GuzzleException
     */
    public static function update(string $idBranchOffice, string $name, array $data): object
    {
        try {
            return FacturamaClient::getInstance()->put('serie/'.$idBranchOffice.'/'.$name, $data);
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
     * Get Series
     *
     * @param string $idBranchOffice
     * @param array $data
     *
     * @return object
     *
     * @throws Exception
     * @throws GuzzleException
     */
    public static function create(string $idBranchOffice, array $data): object
    {
        try {
            return FacturamaClient::getInstance()->post('serie/'.$idBranchOffice, $data);
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
     * Get Series
     *
     * @param string $idBranchOffice
     * @param string $name
     *
     * @return object
     *
     * @throws Exception
     * @throws GuzzleException
     */
    public static function delete(string $idBranchOffice, string $name): object
    {
        try {
            return FacturamaClient::getInstance()->delete('serie/'.$idBranchOffice.'/'.$name, []);
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
