<?php

namespace Crisvegadev\Facturama;

use Crisvegadev\Facturama\Exception\ResponseException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\RequestOptions;
use Exception;

class FacturamaClient
{
    const VERSION = '2.0.0';
    const USER_AGENT = 'Facturama-PHP-SDK-CFDI4';

    private ClientInterface|GuzzleClient $client;

    private string $baseUri ;
    private string $username;
    private string $password;

    private array $errors = [];

    public static function getInstance(): FacturamaClient
    {

        return new self();
    }

    /**
     * @param array $requestOptions
     * @param null|ClientInterface $httpClient
     * @throws Exception
     */
    public function __construct(array $requestOptions = [], ClientInterface $httpClient = null)
    {
        $dotenv = \Dotenv\Dotenv::createImmutable('./');
        $dotenv->safeLoad();

        if($_ENV["FACTURAMA_SANDBOX_USERNAME"] === null && $_ENV["FACTURAMA_SANDBOX_PASSWORD"] === null){
            throw new Exception('No auth sandbox settings found');
        }
        if($_ENV["FACTURAMA_PRODUCTION_USERNAME"] === null && $_ENV["FACTURAMA_PRODUCTION_PASSWORD"] === null){
            throw new Exception('No auth production settings found');
        }

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

            if ($httpClient && $requestOptions) {
                throw new \InvalidArgumentException('If argument 3 is provided, argument 4 must be omitted or passed with `null` as value');
            }
            $requestOptions += [
                RequestOptions::HEADERS => ['User-Agent' => self::USER_AGENT],
                RequestOptions::AUTH => [$this->username, $this->password],
                RequestOptions::CONNECT_TIMEOUT => 10,
                RequestOptions::TIMEOUT => 60,
            ];
            $this->client = $httpClient ?: new GuzzleClient($requestOptions);
        }else{
            throw new \InvalidArgumentException('You must provide a username and password');
        }

    }

    /**
     * Get Request
     *
     * @param string $path
     * @param array $params
     * @return mixed|null
     * @throws GuzzleException
     * @throws ResponseException
     */
    public function get(string $path, array $params = []): mixed
    {
        return $this->executeRequest('GET', $path, [RequestOptions::QUERY => $params, RequestOptions::HTTP_ERRORS => false]);
    }

    /**
     * POST Request
     *
     * @param string $path
     * @param array $body
     * @param array|null $params
     * @return mixed|null
     * @throws GuzzleException
     * @throws ResponseException
     */
    public function post(string $path, array $body = [], array $params = null): mixed
    {
        return $this->executeRequest('POST', $path, [RequestOptions::JSON => $body, RequestOptions::QUERY => $params, RequestOptions::HTTP_ERRORS => false]);
    }

    /**
     * PUT Request
     *
     * @param string $path
     * @param array|null $body
     * @param array $params
     * @return mixed|null
     * @throws GuzzleException
     * @throws ResponseException
     */
    public function put(string $path, array $body = null, array $params = []): mixed
    {
        return $this->executeRequest('PUT', $path, [RequestOptions::JSON => $body, RequestOptions::QUERY => $params, RequestOptions::HTTP_ERRORS => false]);
    }

    /**
     * DELETE Request
     *
     * @param string $path
     * @param array $params
     * @return mixed|null
     * @throws GuzzleException
     * @throws ResponseException
     */
    public function delete(string $path, array $params = []): mixed
    {
        return $this->executeRequest('DELETE', $path, [RequestOptions::QUERY => $params, RequestOptions::HTTP_ERRORS => false]);
    }

    /**
     *
     * @param string $method
     * @param string $url
     * @param array $options
     * @return mixed|null
     * @throws GuzzleException
     * @throws ResponseException
     * @throws Exception
     */
    private function executeRequest(string $method,string $url, array $options = []): mixed
    {
        $response = $this->client->request($method, $this->baseUri.$url, $options);


        if ($response->getStatusCode() == 200 || $response->getStatusCode() == 201) {
            $content = trim($response->getBody()->getContents());

            if (!($object = json_decode($content)) && JSON_ERROR_NONE !== ($jsonLastError = json_last_error())) {
                throw new ResponseException(
                    sprintf('Response body could not be parsed since it doesn\'t contain a valid JSON structure, %s (%d): %s', json_last_error_msg(), $jsonLastError, $content)
                );
            }

            return (object) [
                'statusCode' => $response->getStatusCode(),
                'statusMessage' => $response->getReasonPhrase(),
                'data' => $object
            ];

        } else if ($response->getStatusCode() == 204) {

            return (object) [
                'statusCode' => $response->getStatusCode(),
                'statusMessage' => $response->getReasonPhrase(),
                'data' => "No Content"
            ];

        } else if ($response->getStatusCode() == 404) {
            return (object) [
                'statusCode' => $response->getStatusCode(),
                'statusMessage' => $response->getReasonPhrase(),
                'errors' => [
                    "404" => "Not Found"
                ]
            ];
        }else {

            $errorObject = json_decode($response->getBody()->getContents());

            if(isset($errorObject->ModelState)){
                foreach ($errorObject->ModelState as $key => $value) {
                    $this->errors[$key] = $value;
                }
            }else {
                $this->errors[$response->getStatusCode()] = [
                    $errorObject->Message
                ];
            }

            return (object) [
                'statusCode' => $response->getStatusCode(),
                'statusMessage' => $response->getReasonPhrase(),
                'errors' => $this->errors
            ];

        }
    }
}
