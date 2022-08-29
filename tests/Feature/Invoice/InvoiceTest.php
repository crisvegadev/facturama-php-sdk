<?php declare(strict_types=1);

namespace Invoice;

use Crisvegadev\Facturama\client\FacturamaClient;
use Crisvegadev\Facturama\Service\InvoiceService;
use PHPUnit\Framework\TestCase;
use Exception;
use TypeError;

class InvoiceTest extends TestCase
{

    public function testCanGetAllInvoices()
    {
        $facturamaClientMock = $this->createMock(FacturamaClient::class);

        $facturamaClientMock->method('get')
            ->willReturn((object)[
                'statusCode' => 200,
                'statusMessage' => 'Success',
                'data' => []
            ]);

        $invoice = new InvoiceService($facturamaClientMock);
        $this->assertInstanceOf(InvoiceService::class, $invoice);

        $this->assertEquals((object)[
            'statusCode' => 200,
            'statusMessage' => 'Success',
            'data' => []
        ], $invoice->getAll('issued'));
    }

    public function testStatusMustBeProvided()
    {
        $facturamaClientMock = $this->createMock(FacturamaClient::class);

        $facturamaClientMock->method('get')
            ->willThrowException(new Exception('No status provided'));

        $invoice = new InvoiceService($facturamaClientMock);
        $this->assertInstanceOf(InvoiceService::class, $invoice);

        $this->expectException(TypeError::class);
        $invoice->getALl();
    }


    public function testCanGetCancellationAcuse()
    {
        $facturamaClientMock = $this->createMock(FacturamaClient::class);

        $facturamaClientMock->method('get')
            ->willReturn((object)[
                'statusCode' => 200,
                'statusMessage' => 'Success',
                'data' => []
            ]);

        $invoice = new InvoiceService($facturamaClientMock);
        $this->assertInstanceOf(InvoiceService::class, $invoice);

        $this->assertEquals((object)[
            'statusCode' => 200,
            'statusMessage' => 'Success',
            'data' => []
        ], $invoice->cancellationAccuse('id', 'issued', '02', null));
    }

    public function testCanGetPDFonBase64()
    {
        $facturamaClientMock = $this->createMock(FacturamaClient::class);

        $facturamaClientMock->method('get')
            ->willReturn((object)[
                'statusCode' => 200,
                'statusMessage' => 'Success',
                'data' => []
            ]);

        $invoice = new InvoiceService($facturamaClientMock);
        $this->assertInstanceOf(InvoiceService::class, $invoice);

        $this->assertEquals((object)[
            'statusCode' => 200,
            'statusMessage' => 'Success',
            'data' => []
        ], $invoice->streamFile('pdf', 'issued', '02'));
    }
}
