<?php declare(strict_types=1);

namespace Crisvegadev\Facturama\enums;

enum InvoiceStatus: string{

    case Issued = 'issued';
    case Received = 'received';
    case Payroll = 'payroll';

    public function toString(): string
    {
        return match($this) {
            self::Issued   => 'issued',
            self::Received   => 'received',
            self::Payroll   => 'payroll',
        };
    }

}
