<?php declare(strict_types=1);

namespace Invoice;

use Crisvegadev\Facturama\client\FacturamaClient;
use Crisvegadev\Facturama\Exception\BadRequestException;
use Crisvegadev\Facturama\Service\InvoiceService;
use Exception;
use PHPUnit\Framework\TestCase;
use TypeError;

class CreateInvoiceTest extends TestCase
{
    public function testCanCreateAnInvoiceIfAllIsSuccess(): void
    {
        $facturamaClientMock = $this->createMock(FacturamaClient::class);

        $facturamaClientMock
            ->method('post')
            ->willReturn((object)[
                'statusCode' => 201,
                'statusMessage' => 'Success',
                'data' => []
            ]);

        $invoice = new InvoiceService($facturamaClientMock);
        $this->assertInstanceOf(InvoiceService::class, $invoice);

        $this->assertEquals((object)[
            'statusCode' => 201,
            'statusMessage' => 'Success',
            'data' => []
        ], $invoice->create(data: ['data' => 'data']));
    }

    public function testCannotCreateAnInvoiceIfAnyFieldIsMissing()
    {
        $facturamaClient = $this->createMock(FacturamaClient::class);

        $facturamaClient
            ->method('post')
            ->willThrowException(
                new BadRequestException(
                    'El campo folio fiscal es obligatorio',
                    0,
                    null,
                    (object)[]
                )
            );

        $invoice = new InvoiceService($facturamaClient);
        $this->assertInstanceOf(InvoiceService::class, $invoice);

        $this->assertEquals((object)[
            'statusCode' => 400,
            'statusMessage' => 'Invalid Request',
            'message' => 'El campo folio fiscal es obligatorio',
            'data' => [],
            'errors' => [
                "error.general" => "An error occurred"
            ]
        ], $invoice->create(['data' => 'data']));

    }

    public function testDataMustBeArray()
    {

        $facturamaClientMock = $this->createMock(FacturamaClient::class);

        $facturamaClientMock->method('post')
            ->willThrowException(new TypeError());

        $invoice = new InvoiceService($facturamaClientMock);
        $this->assertInstanceOf(InvoiceService::class, $invoice);

        $this->expectException(TypeError::class);
        $invoice->create('No array');

    }

    public function testDataMustNotBeEmpty()
    {

        $facturamaClientMock = $this->createMock(FacturamaClient::class);

        $facturamaClientMock->method('post')
            ->willThrowException(new Exception('No data provided'));

        $invoice = new InvoiceService($facturamaClientMock);
        $this->assertInstanceOf(InvoiceService::class, $invoice);

        $this->assertEquals((object)[
            'statusCode' => 0,
            'statusMessage' => 'App Error',
            'message' => 'No data provided',
            'data' => [],
            'errors' => []
        ], $invoice->create(['data' => 'data']));

    }
}
