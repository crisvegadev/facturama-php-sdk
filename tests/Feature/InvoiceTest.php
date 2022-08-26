<?php declare(strict_types=1);

use Crisvegadev\Facturama\Exception\BadRequestException;
use Crisvegadev\Facturama\FacturamaClient;
use Crisvegadev\Facturama\Invoice;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;

final class InvoiceTest extends TestCase
{
    public function testCanBeCreated(): void
    {
        $this->assertInstanceOf(Invoice::class, new Invoice());
    }

    /**
     * Verify that the data is an array
     *
     * @test
     * @throws Exception
     * @throws GuzzleException
     */
    public function dataMustBeArray(){

        $invoice = new Invoice();
        $this->expectException(TypeError::class);
        $invoice->create('data');

    }

    public function testCannotCreateAnInvoiceIfAnyFieldIsMissing(): void
    {
        // Mock FacturamaClient
        $facturamaClient = $this->createMock(FacturamaClient::class);

        // Mock the post method
        $facturamaClient->method('post')->willThrowException(new BadRequestException('El campo folio fiscal es obligatorio', 0, null, (object)[

        ]));

        $invoice = new Invoice($facturamaClient);
        $this->assertInstanceOf(Invoice::class, $invoice);

        $this->assertEquals((object)[
            'statusCode' => 400,
            'statusMessage' => 'Invalid Request',
            'message' => 'El campo folio fiscal es obligatorio',
            'data' => [],
            'errors' => [
                "message" => "An error occurred"
            ]
        ], $invoice->create(['data' => 'data']));


    }
}
