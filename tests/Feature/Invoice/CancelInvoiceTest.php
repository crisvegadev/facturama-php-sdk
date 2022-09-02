<?php declare(strict_types=1);

namespace Invoice;

use Crisvegadev\Facturama\client\FacturamaClient;
use Crisvegadev\Facturama\enums\InvoiceStatus;
use Crisvegadev\Facturama\Service\Invoice\InvoiceService;
use Crisvegadev\Facturama\Service\ResponseData;
use PHPUnit\Framework\TestCase;
use TypeError;
use Exception;

class CancelInvoiceTest extends TestCase{

    public function testCanCancelAnInvoice(){
        $facturamaClientMock = $this->createMock(FacturamaClient::class);

        $facturamaClientMock->method('delete')
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
        ]), $invoice->cancel('id', InvoiceStatus::Issued, '02', null));
    }

    public function testCannotCancelAnInvoiceIfIdIsMissing(){
        $facturamaClientMock = $this->createMock(FacturamaClient::class);

        $facturamaClientMock->method('delete')
            ->willThrowException(new TypeError());

        $invoice = new InvoiceService($facturamaClientMock);
        $this->assertInstanceOf(InvoiceService::class, $invoice);

        $this->expectException(TypeError::class);
        $invoice->cancel();
    }

    public function testIdMustBeString(){
        $facturamaClientMock = $this->createMock(FacturamaClient::class);

        $facturamaClientMock->method('delete')
            ->willThrowException(new TypeError());

        $invoice = new InvoiceService($facturamaClientMock);
        $this->assertInstanceOf(InvoiceService::class, $invoice);

        $this->expectException(TypeError::class);
        $invoice->cancel(id: 1);
    }

    public function testTypeMustBeProvided(){
        $facturamaClientMock = $this->createMock(FacturamaClient::class);

        $facturamaClientMock->method('delete')
            ->willThrowException(new Exception('No status provided'));

        $invoice = new InvoiceService($facturamaClientMock);
        $this->assertInstanceOf(InvoiceService::class, $invoice);

        $this->expectException(TypeError::class);
        $invoice->cancel(id: 1);
    }

    public function testTypeMustBeString(){
        $facturamaClientMock = $this->createMock(FacturamaClient::class);

        $facturamaClientMock->method('delete')
            ->willThrowException(new TypeError());

        $invoice = new InvoiceService($facturamaClientMock);
        $this->assertInstanceOf(InvoiceService::class, $invoice);

        $this->expectException(TypeError::class);
        $invoice->cancel(id: '1', type: 1);
    }

    public function testMotiveMustBeProvided(){
        $facturamaClientMock = $this->createMock(FacturamaClient::class);

        $facturamaClientMock->method('delete')
            ->willThrowException(new Exception('No status provided'));

        $invoice = new InvoiceService($facturamaClientMock);
        $this->assertInstanceOf(InvoiceService::class, $invoice);

        $this->expectException(TypeError::class);
        $invoice->cancel(id: '1', type: 'issued');
    }

    public function testMotiveMustBeString(){
        $facturamaClientMock = $this->createMock(FacturamaClient::class);

        $facturamaClientMock->method('delete')
            ->willThrowException(new TypeError());

        $invoice = new InvoiceService($facturamaClientMock);
        $this->assertInstanceOf(InvoiceService::class, $invoice);

        $this->expectException(TypeError::class);
        $invoice->cancel(id: '1', type: 'issued', motive: 1);
    }

    public function testUuidReplacementMustBeString(){
        $facturamaClientMock = $this->createMock(FacturamaClient::class);

        $facturamaClientMock->method('post')
            ->willThrowException(new TypeError());

        $invoice = new InvoiceService($facturamaClientMock);
        $this->assertInstanceOf(InvoiceService::class, $invoice);

        $this->expectException(TypeError::class);
        $invoice->cancel(id: '1', type: 'issued', motive: 'test', uuidReplacement: 1);
    }

}
