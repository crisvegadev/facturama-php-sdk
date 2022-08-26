<?php declare(strict_types=1);

use Crisvegadev\Facturama\Exception\ResponseException;
use Crisvegadev\Facturama\FacturamaClient;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;

final class FacturamaClientTest extends TestCase
{
    public function testCanBeCreated(): void
    {
        putenv("APP_CLOSED=true");

        $this->assertInstanceOf(FacturamaClient::class, new FacturamaClient());
    }

    /**
     * @throws Exception
     */
    public function testCanBeCreatedWithOptions(): void
    {
        $this->assertInstanceOf(FacturamaClient::class, new FacturamaClient([
            'base_uri' => 'https://apisandbox.facturama.mx/',
            'username' => 'username',
            'password' => 'password',
        ]));
    }

    /**
     * @throws GuzzleException
     * @throws ResponseException
     */
    public function testCanMakeGetRequest(): void
    {
        $mock = $this->getMockBuilder(FacturamaClient::class)
            ->setConstructorArgs([[
                'base_uri' => 'https://apisandbox.facturama.mx/',
                'username' => 'username',
                'password' => 'password',
            ]])->getMock();

       $mock->method('get')->willReturn((object)[
           'statusCode' => 200,
           'statusMessage' => "Success",
           'data' => []
       ]);

       $this->assertEquals((object)[
           'statusCode' => 200,
           'statusMessage' => "Success",
           'data' => []
       ], $mock->get('/'));

    }

}
