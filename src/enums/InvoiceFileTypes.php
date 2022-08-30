<?php declare(strict_types=1);

namespace Crisvegadev\Facturama\enums;

enum InvoiceFileTypes: string{

    case Pdf = 'pdf';
    case Html = 'html';
    case Xml = 'xml';

    public function toString(): string
    {
        return match($this) {
            self::Pdf   => 'pdf',
            self::Html   => 'html',
            self::Xml   => 'xml',
        };
    }

}
