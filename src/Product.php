<?php

namespace Crisvegadev\Facturama;

use Crisvegadev\Facturama\Exception\UnauthorizedException;
use Crisvegadev\Facturama\Exception\BadRequestException;
use Crisvegadev\Facturama\Exception\NotFoundException;
use Crisvegadev\Facturama\Exception\ServerException;
use GuzzleHttp\Exception\GuzzleException;
use Exception;

class Product
{
    /**
     * Get all products
     *
     * @return object
     *
     * @throws Exception
     * @throws GuzzleException
     */
    public static function getAll(): object
    {
        try {

            return FacturamaClient::getInstance()->get('Product', []);

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
     * Get single product
     *
     * @param string $id
     *
     * @return object
     *
     * @throws Exception
     * @throws GuzzleException
     */
    public static function get(string $id): object
    {
        try {
            return FacturamaClient::getInstance()->get('Product/'.$id, []);
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
     * Get single product
     *
     * @param string $keyword
     *
     * @return object
     *
     * @throws Exception
     * @throws GuzzleException
     */
    public static function search(string $keyword): object
    {
        try {

            return FacturamaClient::getInstance()->get('Products', [
                "keyword" => $keyword
            ]);

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
     * Create product
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
            return FacturamaClient::getInstance()->post('Product/', $data);
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
     * Delete product
     *
     * @param string $id
     *
     * @return object
     *
     * @throws Exception
     * @throws GuzzleException
     */
    public static function delete(string $id): object
    {
        try {
            return FacturamaClient::getInstance()->delete('Product/'.$id);
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
