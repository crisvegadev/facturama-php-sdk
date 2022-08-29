<?php declare(strict_types=1);

namespace Invoice;

use Crisvegadev\Facturama\client\FacturamaClient;
use Crisvegadev\Facturama\Service\InvoiceService;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;
use TypeError;

class GetAllInvoicesTest extends TestCase{

    public function testCanGetAllInvoices(): void
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

}
