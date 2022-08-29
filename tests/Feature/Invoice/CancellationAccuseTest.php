<?php declare(strict_types=1);

namespace Invoice;

use Crisvegadev\Facturama\client\FacturamaClient;
use Crisvegadev\Facturama\Service\InvoiceService;
use PHPUnit\Framework\TestCase;
use TypeError;

class CancellationAccuseTest extends TestCase{

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
        ], $invoice->cancellationAccuse('pdf', 'issued', '02', null));
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
        $invoice->cancellationAccuse(format: 1);
    }

    public function testTypeMustBeProvided()
    {
        $facturamaClientMock = $this->createMock(FacturamaClient::class);

        $facturamaClientMock->method('get')
            ->willThrowException(new TypeError());

        $invoice = new InvoiceService($facturamaClientMock);
        $this->assertInstanceOf(InvoiceService::class, $invoice);

        $this->expectException(TypeError::class);
        $invoice->cancellationAccuse(format: 'pdf');

    }

    public function testTypeMustBeString()
    {
        $facturamaClientMock = $this->createMock(FacturamaClient::class);

        $facturamaClientMock->method('get')
            ->willThrowException(new TypeError());

        $invoice = new InvoiceService($facturamaClientMock);
        $this->assertInstanceOf(InvoiceService::class, $invoice);

        $this->expectException(TypeError::class);
        $invoice->cancellationAccuse(format: '1', type: 1);

    }

    public function testIdMustBeProvided()
    {
        $facturamaClientMock = $this->createMock(FacturamaClient::class);

        $facturamaClientMock->method('get')
            ->willThrowException(new TypeError());

        $invoice = new InvoiceService($facturamaClientMock);
        $this->assertInstanceOf(InvoiceService::class, $invoice);

        $this->expectException(TypeError::class);
        $invoice->cancellationAccuse(format: 'pdf', type: 'issued');

    }

    public function testIdMustBeString()
    {
        $facturamaClientMock = $this->createMock(FacturamaClient::class);

        $facturamaClientMock->method('get')
            ->willThrowException(new TypeError());

        $invoice = new InvoiceService($facturamaClientMock);
        $this->assertInstanceOf(InvoiceService::class, $invoice);

        $this->expectException(TypeError::class);
        $invoice->cancellationAccuse(format: '1', type: 'issued', id: 1);

    }

}
