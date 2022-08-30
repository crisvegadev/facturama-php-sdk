<?php declare(strict_types=1);

namespace Invoice;

use Crisvegadev\Facturama\client\FacturamaClient;
use Crisvegadev\Facturama\enums\InvoiceStatus;
use Crisvegadev\Facturama\Service\Invoice\InvoiceService;
use Crisvegadev\Facturama\Service\ResponseData;
use Exception;
use PHPUnit\Framework\TestCase;
use TypeError;

class GetAllInvoicesTest extends TestCase{

    public function testCanGetAllInvoices(): void
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
        ]), $invoice->getAll(InvoiceStatus::Issued));
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

}
