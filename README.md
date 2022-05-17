# Facturama SDK PHP (BETA)

[NOTE] This is a custom fork and a unofficial library of [Facturama PHP SDK](https://github.com/Facturama/facturama-php-sdk)

[NOTE] This library requires PHP 5.6 as minimum

[NOTE] This library is for CFDI 4.0

## How do I install it?

    composer require crisvegadev/facturama-php-sdk

### Set the environment variables


Create an `.env` in your root path and write the following:
```php
FACTURAMA_ENVIRONMENT=sandbox

FACTURAMA_SANDBOX_URL=https://apisandbox.facturama.mx/
FACTURAMA_SANDBOX_USERNAME=<your_username>
FACTURAMA_SANDBOX_PASSWORD=<your_password>

FACTURAMA_PRODUCTION_URL=https://api.facturama.mx/
FACTURAMA_PRODUCTION_USERNAME=<your_username>
FACTURAMA_PRODUCTION_PASSWORD=<your_password>
```

## API operations

- Create, get CFDIs; download XMLs and PDFs;
- CRUDs for Product, Customer, Branch office and series.

*All operations will be reflected on Facturama's web app.*
