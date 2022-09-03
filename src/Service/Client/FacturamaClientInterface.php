<?php declare(strict_types=1);

namespace Crisvegadev\Facturama\Service\Client;

use Crisvegadev\Facturama\Exception\UnauthorizedException;
use Crisvegadev\Facturama\Exception\BadRequestException;
use Crisvegadev\Facturama\Exception\NotFoundException;
use Crisvegadev\Facturama\Exception\ResponseException;
use Crisvegadev\Facturama\Exception\ServerException;
use Crisvegadev\Facturama\Exception\AppException;

interface FacturamaClientInterface
{
    /**
     * @param string $url
     * @param array $params
     *
     * @throws BadRequestException
     * @throws AppException
     * @throws UnauthorizedException
     * @throws ServerException
     * @throws NotFoundException
     * @throws ResponseException
     */
    public function get(string $url, array $params = []): array;

    /**
     * @param string $url
     * @param array $body
     * @param array $params
     *
     * @throws BadRequestException
     * @throws AppException
     * @throws UnauthorizedException
     * @throws ServerException
     * @throws NotFoundException
     * @throws ResponseException
     */
    public function post(string $url, array $body = [], array $params = []): array;

    /**
     * @param string $url
     * @param array $body
     * @param array $params
     *
     * @return array
     * @throws BadRequestException
     * @throws AppException
     * @throws UnauthorizedException
     * @throws ServerException
     * @throws NotFoundException
     * @throws ResponseException
     */
    public function put(string $url, array $body = [], array $params = []): array;

    /**
     * @param string $url
     * @param array $params
     *
     * @throws BadRequestException
     * @throws AppException
     * @throws UnauthorizedException
     * @throws ServerException
     * @throws NotFoundException
     * @throws ResponseException
     */
    public function delete(string $url, array $params = []): array;

    /**
     * @param string $method
     * @param string $url
     * @param array $options
     *
     * @throws BadRequestException
     * @throws AppException
     * @throws UnauthorizedException
     * @throws ServerException
     * @throws NotFoundException
     * @throws ResponseException
     */
    public function executeRequest(string $method, string $url, array $options = []): array;

}
