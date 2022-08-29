<?php declare(strict_types=1);

namespace Invoice;

use Crisvegadev\Facturama\client\FacturamaClient;
use Crisvegadev\Facturama\Service\InvoiceService;
use PHPUnit\Framework\TestCase;
use Exception;
use TypeError;

class DownloadInvoiceTest extends TestCase
{

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

    public function testCannotGetPDFonBase64IfAnyFieldIsMissing()
    {
        $facturamaClientMock = $this->createMock(FacturamaClient::class);

        $facturamaClientMock->method('get')
            ->willThrowException(new TypeError());

        $invoice = new InvoiceService($facturamaClientMock);
        $this->assertInstanceOf(InvoiceService::class, $invoice);

        $this->expectException(TypeError::class);
        $invoice->streamFile();
    }

    public function testFileTypeMustBeProvided()
    {
        $facturamaClientMock = $this->createMock(FacturamaClient::class);

        $facturamaClientMock->method('get')
            ->willThrowException(new TypeError());

        $invoice = new InvoiceService($facturamaClientMock);
        $this->assertInstanceOf(InvoiceService::class, $invoice);

        $this->expectException(TypeError::class);
        $invoice->streamFile(type: 'issued', id: '1');
    }

    public function testFileTypeMustBeString(){
        $facturamaClientMock = $this->createMock(FacturamaClient::class);

        $facturamaClientMock->method('get')
            ->willThrowException(new TypeError());

        $invoice = new InvoiceService($facturamaClientMock);
        $this->assertInstanceOf(InvoiceService::class, $invoice);

        $this->expectException(TypeError::class);
        $invoice->streamFile(fileType: 1, type: 'issued', id: '1');
    }

    public function testTypeMustBeProvided()
    {
        $facturamaClientMock = $this->createMock(FacturamaClient::class);

        $facturamaClientMock->method('get')
            ->willThrowException(new TypeError());

        $invoice = new InvoiceService($facturamaClientMock);
        $this->assertInstanceOf(InvoiceService::class, $invoice);

        $this->expectException(TypeError::class);
        $invoice->streamFile(fileType: 'pdf', id: '1');
    }

    public function testTypeMustBeString(){
        $facturamaClientMock = $this->createMock(FacturamaClient::class);

        $facturamaClientMock->method('get')
            ->willThrowException(new TypeError());

        $invoice = new InvoiceService($facturamaClientMock);
        $this->assertInstanceOf(InvoiceService::class, $invoice);

        $this->expectException(TypeError::class);
        $invoice->streamFile(fileType: 'pdf', type: 1, id: '1');
    }

    public function testIdMustBeProvided()
    {
        $facturamaClientMock = $this->createMock(FacturamaClient::class);

        $facturamaClientMock->method('get')
            ->willThrowException(new TypeError());

        $invoice = new InvoiceService($facturamaClientMock);
        $this->assertInstanceOf(InvoiceService::class, $invoice);

        $this->expectException(TypeError::class);
        $invoice->streamFile(fileType: 'pdf', type: 'issued');
    }

    public function testIdMustBeString(){
        $facturamaClientMock = $this->createMock(FacturamaClient::class);

        $facturamaClientMock->method('get')
            ->willThrowException(new TypeError());

        $invoice = new InvoiceService($facturamaClientMock);
        $this->assertInstanceOf(InvoiceService::class, $invoice);

        $this->expectException(TypeError::class);
        $invoice->streamFile(fileType: 'pdf', type: 'issued', id: '1');
    }

}
