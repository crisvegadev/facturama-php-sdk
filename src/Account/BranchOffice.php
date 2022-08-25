<?php

namespace Crisvegadev\Facturama\Account;

use Crisvegadev\Facturama\Exception\UnauthorizedException;
use Crisvegadev\Facturama\Exception\BadRequestException;
use Crisvegadev\Facturama\Exception\NotFoundException;
use Crisvegadev\Facturama\Exception\ServerException;
use Crisvegadev\Facturama\FacturamaClient;
use GuzzleHttp\Exception\GuzzleException;
use Exception;

class BranchOffice
{
    /**
     * Get branch offices
     *
     * @return object
     *
     * @throws Exception
     * @throws GuzzleException
     */
    public static function getBranchOffices(): object
    {
        try {

            return FacturamaClient::getInstance()->get('BranchOffice', []);

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
     * Get branch offices
     *
     * @param string $id
     *
     * @return object
     *
     * @throws Exception
     * @throws GuzzleException
     */
    public static function getBranchOfficeById($id): object
    {
        try {

            return FacturamaClient::getInstance()->get('BranchOffice/'.$id, []);

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
     * Update branch office
     *
     * @param string $id
     * @param array $data
     *
     * @return object
     *
     * @throws Exception
     * @throws GuzzleException
     */
    public static function updateBranchOffice(string $id, array $data): object
    {
        try {

            return FacturamaClient::getInstance()->put('BranchOffice/'.$id, $data);

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
     * Create branch office
     *
     * @param array $data
     *
     * @return object
     *
     * @throws Exception
     * @throws GuzzleException
     */
    public static function createBranchOffice(array $data): object
    {
        try {

            return FacturamaClient::getInstance()->post('BranchOffice', $data);

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
     * Delete branch office
     *
     * @param string $id
     *
     * @return object
     *
     * @throws Exception
     * @throws GuzzleException
     */
    public static function deleteBranchOffice(string $id): object
    {
        try {

            return FacturamaClient::getInstance()->delete('BranchOffice/'.$id, []);

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
