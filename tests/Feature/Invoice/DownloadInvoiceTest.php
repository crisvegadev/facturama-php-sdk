<?php declare(strict_types=1);

namespace Invoice;

use Crisvegadev\Facturama\Service\Client\FacturamaGuzzleClient;
use Crisvegadev\Facturama\Service\Invoice\InvoiceService;
use Crisvegadev\Facturama\Service\ResponseData;
use PHPUnit\Framework\TestCase;
use Exception;
use TypeError;

class DownloadInvoiceTest extends TestCase
{

    public function testCanGetPDFonBase64()
    {
        $facturamaClientMock = $this->createMock(FacturamaGuzzleClient::class);

        $facturamaClientMock->method('get')
            ->willReturn([
                'statusCode' => 200,
                'statusMessage' => 'Success',
                'message' => '',
                'data' => [],
                'errors' => []
            ]);

        $invoice = new InvoiceService($facturamaClientMock);
        $this->assertInstanceOf(InvoiceService::class, $invoice);

        $this->assertEquals(ResponseData::fromArray([
            'statusCode' => 200,
            'statusMessage' => 'Success',
            'message' => '',
            'data' => [],
            'errors' => []
        ]), $invoice->streamFile('pdf', 'issued', '02'));
    }

    public function testCannotGetPDFonBase64IfAnyFieldIsMissing()
    {
        $facturamaClientMock = $this->createMock(FacturamaGuzzleClient::class);

        $facturamaClientMock->method('get')
            ->willThrowException(new TypeError());

        $invoice = new InvoiceService($facturamaClientMock);
        $this->assertInstanceOf(InvoiceService::class, $invoice);

        $this->expectException(TypeError::class);
        $invoice->streamFile();
    }

    public function testFileTypeMustBeProvided()
    {
        $facturamaClientMock = $this->createMock(FacturamaGuzzleClient::class);

        $facturamaClientMock->method('get')
            ->willThrowException(new TypeError());

        $invoice = new InvoiceService($facturamaClientMock);
        $this->assertInstanceOf(InvoiceService::class, $invoice);

        $this->expectException(TypeError::class);
        $invoice->streamFile(type: 'issued', id: '1');
    }

    public function testFileTypeMustBeString(){
        $facturamaClientMock = $this->createMock(FacturamaGuzzleClient::class);

        $facturamaClientMock->method('get')
            ->willThrowException(new TypeError());

        $invoice = new InvoiceService($facturamaClientMock);
        $this->assertInstanceOf(InvoiceService::class, $invoice);

        $this->expectException(TypeError::class);
        $invoice->streamFile(fileType: 1, type: 'issued', id: '1');
    }

    public function testTypeMustBeProvided()
    {
        $facturamaClientMock = $this->createMock(FacturamaGuzzleClient::class);

        $facturamaClientMock->method('get')
            ->willThrowException(new TypeError());

        $invoice = new InvoiceService($facturamaClientMock);
        $this->assertInstanceOf(InvoiceService::class, $invoice);

        $this->expectException(TypeError::class);
        $invoice->streamFile(fileType: 'pdf', id: '1');
    }

    public function testTypeMustBeString(){
        $facturamaClientMock = $this->createMock(FacturamaGuzzleClient::class);

        $facturamaClientMock->method('get')
            ->willThrowException(new TypeError());

        $invoice = new InvoiceService($facturamaClientMock);
        $this->assertInstanceOf(InvoiceService::class, $invoice);

        $this->expectException(TypeError::class);
        $invoice->streamFile(fileType: 'pdf', type: 1, id: '1');
    }

    public function testIdMustBeProvided()
    {
        $facturamaClientMock = $this->createMock(FacturamaGuzzleClient::class);

        $facturamaClientMock->method('get')
            ->willThrowException(new TypeError());

        $invoice = new InvoiceService($facturamaClientMock);
        $this->assertInstanceOf(InvoiceService::class, $invoice);

        $this->expectException(TypeError::class);
        $invoice->streamFile(fileType: 'pdf', type: 'issued');
    }

    public function testIdMustBeString(){
        $facturamaClientMock = $this->createMock(FacturamaGuzzleClient::class);

        $facturamaClientMock->method('get')
            ->willThrowException(new TypeError());

        $invoice = new InvoiceService($facturamaClientMock);
        $this->assertInstanceOf(InvoiceService::class, $invoice);

        $this->expectException(TypeError::class);
        $invoice->streamFile(fileType: 'pdf', type: 'issued', id: '1');
    }

}
