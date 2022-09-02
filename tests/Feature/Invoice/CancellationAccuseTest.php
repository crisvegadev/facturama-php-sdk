<?php declare(strict_types=1);

namespace Invoice;

use Crisvegadev\Facturama\client\FacturamaClient;
use Crisvegadev\Facturama\enums\InvoiceFileTypes;
use Crisvegadev\Facturama\enums\InvoiceStatus;
use Crisvegadev\Facturama\Service\Invoice\InvoiceService;
use Crisvegadev\Facturama\Service\ResponseData;
use PHPUnit\Framework\TestCase;
use TypeError;

class CancellationAccuseTest extends TestCase{

    public function testCanGetCancellationAcuse()
    {
        $facturamaClientMock = $this->createMock(FacturamaClient::class);

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
        ]), $invoice->cancellationAccuse('pdf', 'issued', '02', null));
    }

    public function testCannotGetCancellationAcuseIfIdIsMissing(){
        $facturamaClientMock = $this->createMock(FacturamaClient::class);

        $facturamaClientMock->method('get')
            ->willThrowException(new TypeError());

        $invoice = new InvoiceService($facturamaClientMock);
        $this->assertInstanceOf(InvoiceService::class, $invoice);

        $this->expectException(TypeError::class);
        $invoice->cancellationAccuse();
    }

    public function testFormatMustBeProvided()
    {
        $facturamaClientMock = $this->createMock(FacturamaClient::class);

        $facturamaClientMock->method('get')
            ->willThrowException(new TypeError());

        $invoice = new InvoiceService($facturamaClientMock);
        $this->assertInstanceOf(InvoiceService::class, $invoice);

        $this->expectException(TypeError::class);
        $invoice->cancellationAccuse(type: 'issued', id: 1);

    }

    public function testFormatMustBeString(){
        $facturamaClientMock = $this->createMock(FacturamaClient::class);

        $facturamaClientMock->method('get')
            ->willThrowException(new TypeError());

        $invoice = new InvoiceService($facturamaClientMock);
        $this->assertInstanceOf(InvoiceService::class, $invoice);

        $this->expectException(TypeError::class);
        $invoice->cancellationAccuse(fileType: 1);
    }

    public function testTypeMustBeProvided()
    {
        $facturamaClientMock = $this->createMock(FacturamaClient::class);

        $facturamaClientMock->method('get')
            ->willThrowException(new TypeError());

        $invoice = new InvoiceService($facturamaClientMock);
        $this->assertInstanceOf(InvoiceService::class, $invoice);

        $this->expectException(TypeError::class);
        $invoice->cancellationAccuse(fileType: 'pdf');

    }

    public function testTypeMustBeString()
    {
        $facturamaClientMock = $this->createMock(FacturamaClient::class);

        $facturamaClientMock->method('get')
            ->willThrowException(new TypeError());

        $invoice = new InvoiceService($facturamaClientMock);
        $this->assertInstanceOf(InvoiceService::class, $invoice);

        $this->expectException(TypeError::class);
        $invoice->cancellationAccuse(fileType: '1', type: 1);

    }

    public function testIdMustBeProvided()
    {
        $facturamaClientMock = $this->createMock(FacturamaClient::class);

        $facturamaClientMock->method('get')
            ->willThrowException(new TypeError());

        $invoice = new InvoiceService($facturamaClientMock);
        $this->assertInstanceOf(InvoiceService::class, $invoice);

        $this->expectException(TypeError::class);
        $invoice->cancellationAccuse(fileType: 'pdf', type: 'issued');

    }

    public function testIdMustBeString()
    {
        $facturamaClientMock = $this->createMock(FacturamaClient::class);

        $facturamaClientMock->method('get')
            ->willThrowException(new TypeError());

        $invoice = new InvoiceService($facturamaClientMock);
        $this->assertInstanceOf(InvoiceService::class, $invoice);

        $this->expectException(TypeError::class);
        $invoice->cancellationAccuse(fileType: '1', type: 'issued', id: 1);

    }

}
