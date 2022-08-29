<?php declare(strict_types=1);

namespace Crisvegadev\Facturama\client;

use Crisvegadev\Facturama\Exception\AppException;
use Crisvegadev\Facturama\Exception\BadRequestException;
use Crisvegadev\Facturama\Exception\NotFoundException;
use Crisvegadev\Facturama\Exception\ResponseException;
use Crisvegadev\Facturama\Exception\ServerException;
use Crisvegadev\Facturama\Exception\UnauthorizedException;
use Dotenv\Dotenv;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;

class FacturamaClient implements FacturamaClientInterface {

    const VERSION = '2.0.0';
    const USER_AGENT = 'Facturama-PHP-SDK-CFDI4';

    private ClientInterface|GuzzleClient $client;

    private string $baseUri ;
    private string $username;
    private string $password;

    private array $errors = [];

    /**
     * @throws AppException
     */
    public function __construct()
    {
        $dotenv = Dotenv::createImmutable('./');
        $dotenv->safeLoad();

        $dotenv->required(['FACTURAMA_SANDBOX_USERNAME', 'FACTURAMA_SANDBOX_PASSWORD', 'FACTURAMA_SANDBOX_URL'])->notEmpty();
        $dotenv->required(['FACTURAMA_PRODUCTION_USERNAME', 'FACTURAMA_PRODUCTION_PASSWORD', 'FACTURAMA_PRODUCTION_URL'])->notEmpty();

        if($_ENV["FACTURAMA_ENVIRONMENT"] === 'production'){
            $this->baseUri = $_ENV["FACTURAMA_PRODUCTION_URL"];
            $this->username = $_ENV["FACTURAMA_PRODUCTION_USERNAME"];
            $this->password = $_ENV["FACTURAMA_PRODUCTION_PASSWORD"];
        }else{
            $this->baseUri = $_ENV["FACTURAMA_SANDBOX_URL"];
            $this->username = $_ENV["FACTURAMA_SANDBOX_USERNAME"];
            $this->password = $_ENV["FACTURAMA_SANDBOX_PASSWORD"];
        }

        if(isset($this->username) && isset($this->password)){

            $requestOptions = [
                RequestOptions::HEADERS => ['User-Agent' => self::USER_AGENT],
                RequestOptions::AUTH => [$this->username, $this->password],
                RequestOptions::CONNECT_TIMEOUT => 10,
                RequestOptions::TIMEOUT => 60,
            ];

            $this->client = new GuzzleClient($requestOptions);

        }else{
            throw new AppException('You must provide a username and password');
        }

    }

    /**
     * @throws BadRequestException
     * @throws AppException
     * @throws UnauthorizedException
     * @throws ServerException
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws ResponseException
     */
    public function get(string $url, array $params = []): object
    {
        return $this->executeRequest('GET', $url, [RequestOptions::QUERY => $params, RequestOptions::HTTP_ERRORS => false]);
    }

    /**
     * @throws AppException
     * @throws BadRequestException
     * @throws UnauthorizedException
     * @throws ServerException
     * @throws NotFoundException
     * @throws GuzzleException
     * @throws ResponseException
     */
    public function post(string $url, array $body = [], array $params = []): object
    {
        return $this->executeRequest('POST', $url, [RequestOptions::JSON => $body, RequestOptions::QUERY => $params, RequestOptions::HTTP_ERRORS => false]);
    }

    /**
     * @throws BadRequestException
     * @throws AppException
     * @throws UnauthorizedException
     * @throws ServerException
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws ResponseException
     */
    public function put(string $url, array $body = [], array $params = []): object
    {
        return $this->executeRequest('PUT', $url, [RequestOptions::JSON => $body, RequestOptions::QUERY => $params, RequestOptions::HTTP_ERRORS => false]);
    }

    /**
     * @throws BadRequestException
     * @throws AppException
     * @throws UnauthorizedException
     * @throws ServerException
     * @throws NotFoundException
     * @throws GuzzleException
     * @throws ResponseException
     */
    public function delete(string $url, array $params = []): object
    {
        return $this->executeRequest('DELETE', $url, [RequestOptions::QUERY => $params, RequestOptions::HTTP_ERRORS => false]);
    }

    /**
     * @throws BadRequestException
     * @throws AppException
     * @throws UnauthorizedException
     * @throws ServerException
     * @throws GuzzleException
     * @throws NotFoundException
     * @throws ResponseException
     */
    public function executeRequest(string $method, string $url, array $options = []): object
    {
        $response = $this->client->request($method, $this->baseUri.$url, $options);

        if ($response->getStatusCode() === 200 || $response->getStatusCode() === 201 || $response->getStatusCode() === 204) { // 200 = OK, 201 = Created
            $content = trim($response->getBody()->getContents());

            if (!($object = json_decode($content)) && JSON_ERROR_NONE !== ($jsonLastError = json_last_error())) {
                throw new ResponseException(
                    sprintf('Response body could not be parsed since it doesn\'t contain a valid JSON structure, %s (%d): %s', json_last_error_msg(), $jsonLastError, $content)
                );
            }

            return (object) [
                'statusCode' => $response->getStatusCode(),
                'statusMessage' => $response->getReasonPhrase(),
                'data' => $object ?? 'No Content'
            ];

        } else if ($response->getStatusCode() === 400) {

            $dataError = json_decode($response->getBody()->getContents());
            throw new BadRequestException('Bad Request',400, null, $dataError);

        } else if ($response->getStatusCode() === 401) {

            throw new UnauthorizedException("Unauthorized", 401, null);

        } else if ($response->getStatusCode() == 404) {

            throw new NotFoundException("The requested resource was not found", 404, null);

        } else if ($response->getStatusCode() >= 500) {

            $dataError = json_decode($response->getBody()->getContents());
            throw new ServerException("A server error occurred on Facturama", $response->getStatusCode(), null, $dataError);

        } else {

            throw new AppException("An error occurred", 0, null);

        }
    }
}
