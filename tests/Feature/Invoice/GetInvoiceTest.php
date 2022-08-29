<?php declare(strict_types=1);

namespace Invoice;

use Crisvegadev\Facturama\client\FacturamaClient;
use Crisvegadev\Facturama\Service\InvoiceService;
use PHPUnit\Framework\TestCase;
use TypeError;

class GetInvoiceTest extends TestCase{

    public function testCanGetAnInvoiceById(){
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
        ], $invoice->get('id'));
    }

    public function testCannotGetAnInvoiceIfIdIsMissing(){
        $facturamaClientMock = $this->createMock(FacturamaClient::class);

        $facturamaClientMock->method('get')
            ->willThrowException(new TypeError());

        $invoice = new InvoiceService($facturamaClientMock);
        $this->assertInstanceOf(InvoiceService::class, $invoice);

        $this->expectException(TypeError::class);
        $invoice->get();
    }

    public function testIdMustBeString(){
        $facturamaClientMock = $this->createMock(FacturamaClient::class);

        $facturamaClientMock->method('get')
            ->willThrowException(new TypeError());

        $invoice = new InvoiceService($facturamaClientMock);
        $this->assertInstanceOf(InvoiceService::class, $invoice);

        $this->expectException(TypeError::class);
        $invoice->get(id: 1);
    }
}
