## Documentation

* [Account](account.md)
* [Customer](customer.md)
* [Invoice](invoice.md)
* [Product](product.md)

## Products

### Get list of all products

For more information: [Facturama API Get Products](https://apisandbox.facturama.mx/docs/api/GET-Product)

Example:

```php
\Crisvegadev\Facturama\Product::getAll();
```

*Response of type object*

```json
{
    "statusCode": 200,
    "statusMessage": "OK",
    "data": [
        {
            "Id": "IroEhmMygzvUmJ_KWpbmnQ2",
            "UnitCode": "H87",
            "Unit": "PIEZA.",
            "IdentificationNumber": "7",
            "Name": "ACEITE DE TRUFA. ARTE TRUFA.  HG",
            "Description": "ACEITE DE TRUFA. ARTE TRUFA. FRASCO CON 100 ML.",
            "Price": 493.2,
            "CodeProdServ": "50151513",
            "NameCodeProdServ": "Aceites vegetales o  de planta comestibles",
            "CuentaPredial": "",
            "Taxes": [
                {
                    "Name": "IVA",
                    "IsRetention": false,
                    "IsFederalTax": true
                }
            ]
        },
        {
            "Id": "0uJpbFZALRhU-UKJafKxdA2",
            "UnitCode": "E48",
            "Unit": "Unidad de servicio",
            "Name": "aerolineas",
            "Description": "aerolineas",
            "Price": 10.0,
            "CodeProdServ": "70111507",
            "NameCodeProdServ": "Servicios de traslado de árboles, plantas ornamentales",
            "CuentaPredial": "",
            "Taxes": [
                {
                    "Name": "IVA",
                    "Rate": 0.0,
                    "IsRetention": false,
                    "IsFederalTax": true
                },
                {
                    "Name": "iva",
                    "Rate": 0.04,
                    "IsRetention": false,
                    "IsFederalTax": true
                }
            ]
        }
    ]
}
```

### Get product by id

For more information: [Facturama API Get Product](https://apisandbox.facturama.mx/docs/api/GET-Product-id)

| Parameter | Type   | Required ? | 
|-----------|--------|------------|
| `id`      | String | Yes        |

<br>

```php
\Crisvegadev\Facturama\Product::get({id});
```

Example:

```php
\Crisvegadev\Facturama\Product::get("NIUOt3Pgd24ErcrM1OFyag2");
```

*Response (Object):*
```json
{
    "statusCode": 200,
    "statusMessage": "OK",
    "data": {
        "Id": "NIUOt3Pgd24ErcrM1OFyag2",
        "UnitCode": "E48",
        "Unit": "Servicio",
        "IdentificationNumber": "WEB003",
        "Name": "Sitio Web CMS",
        "Description": "Desarrollo e implementación de sitio web empleando un CMS",
        "Price": 6500.0,
        "CodeProdServ": "43232408",
        "NameCodeProdServ": "Software de desarrollo de plataformas web",
        "CuentaPredial": "123",
        "Taxes": [
            {
                "Name": "IVA",
                "Rate": 0.16,
                "IsRetention": false,
                "IsFederalTax": true
            },
            {
                "Name": "ISR",
                "IsRetention": true,
                "IsFederalTax": true,
                "Total": 0.1
            },
            {
                "Name": "IVA",
                "IsRetention": true,
                "IsFederalTax": true,
                "Total": 0.1
            }
        ]
    }
}
```
### Search products

For more information: [Facturama API Search Product](https://apisandbox.facturama.mx/docs/api/GET-Product_keyword)

| Parameter | Type   | Required ? | 
|-----------|--------|------------|
| `keyword` | String | Yes        | 

<br>

```php
\Crisvegadev\Facturama\Product::search({keyword});
```
Example:

```php
\Crisvegadev\Facturama\Product::search('planta');
```

*Response of type object*
```json
{
    "statusCode": 200,
    "statusMessage": "OK",
    "data": [
        {
            "Id": "IroEhmMygzvUmJ_KWpbmnQ2",
            "UnitCode": "H87",
            "Unit": "PIEZA.",
            "IdentificationNumber": "7",
            "Name": "ACEITE DE TRUFA. ARTE TRUFA.  HG",
            "Description": "ACEITE DE TRUFA. ARTE TRUFA. FRASCO CON 100 ML.",
            "Price": 493.2,
            "CodeProdServ": "50151513",
            "NameCodeProdServ": "Aceites vegetales o  de planta comestibles",
            "CuentaPredial": "",
            "Taxes": [
                {
                    "Name": "IVA",
                    "IsRetention": false,
                    "IsFederalTax": true
                }
            ]
        },
        {
            "Id": "0uJpbFZALRhU-UKJafKxdA2",
            "UnitCode": "E48",
            "Unit": "Unidad de servicio",
            "Name": "aerolineas",
            "Description": "aerolineas",
            "Price": 10.0,
            "CodeProdServ": "70111507",
            "NameCodeProdServ": "Servicios de traslado de árboles, o plantas ornamentales",
            "CuentaPredial": "",
            "Taxes": [
                {
                    "Name": "IVA",
                    "Rate": 0.0,
                    "IsRetention": false,
                    "IsFederalTax": true
                },
                {
                    "Name": "iva",
                    "Rate": 0.04,
                    "IsRetention": false,
                    "IsFederalTax": true
                }
            ]
        }
    ]
}
```

### Create a new product:

For more information: [Facturama API Create Product](https://apisandbox.facturama.mx/docs/api/POST-Product)

| Parameter | Type  | Required ? | 
|-----------|-------|------------|
| `data`    | array | Yes        |

<br>

```php
\Crisvegadev\Facturama\Product::create({data});
```

Example:

```php
\Crisvegadev\Facturama\Product::create([
    "Unit" => "Servicio",
    "UnitCode" => "E48",
    "IdentificationNumber" => "WEB003",
    "Name" => "Sitio Web CMS",
    "Description" => "Desarrollo e implementación de sitio web empleando un CMS",
    "Price" => 6500.0,
    "CodeProdServ" => "43232408",
    "CuentaPredial" => "123",
    "Taxes" => [
        [
            "Name" => "IVA",
            "Rate" => 0.16,
            "IsRetention" => false,
            "IsFederalTax" => true
        ],
        [
            "Name" => "ISR",
            "IsRetention" => true,
            "IsFederalTax" => true,
             "Total" => 0.1
        ],
        [
            "Name" => "IVA",
            "IsRetention" => true,
            "IsFederalTax" => true,
            "Total" => 0.106667
        ]
    ]
]);
```

*Response of type object*

```json
{
    "statusCode": 201,
    "statusMessage": "Created",
    "data": {
        "Id": "NIUOt3Pgd24ErcrM1OFyag2",
        "UnitCode": "E48",
        "Unit": "Servicio",
        "IdentificationNumber": "WEB003",
        "Name": "Sitio Web CMS",
        "Description": "Desarrollo e implementación de sitio web empleando un CMS",
        "Price": 6500.0,
        "CodeProdServ": "43232408",
        "NameCodeProdServ": "Software de desarrollo de plataformas web",
        "CuentaPredial": "123",
        "Taxes": [
            {
                "Name": "IVA",
                "Rate": 0.16,
                "IsRetention": false,
                "IsFederalTax": true
            },
            {
                "Name": "ISR",
                "IsRetention": true,
                "IsFederalTax": true,
                "Total": 0.1
            },
            {
                "Name": "IVA",
                "IsRetention": true,
                "IsFederalTax": true,
                "Total": 0.1
            }
        ]
    }
}
```
### Delete a product

For more information: [Facturama API Delete Product](https://apisandbox.facturama.mx/docs/api/DELETE-Product-id)


| Parameter | Type   | Required ? | 
|-----------|--------|------------|
| `id`      | String | Yes        |   

<br>

```php
\Crisvegadev\Facturama\Product::delete({id});
```

Example:

```php
\Crisvegadev\Facturama\Product::delete('NIUOt3Pgd24ErcrM1OFyag2');
```

*Response of type object*
```json
{
    "statusCode": 204,
    "statusMessage": "No Content",
    "data": {
        "Id": "NIUOt3Pgd24ErcrM1OFyag2",
        "UnitCode": "E48",
        "Unit": "Servicio",
        "IdentificationNumber": "WEB003",
        "Name": "Sitio Web CMS",
        "Description": "Desarrollo e implementación de sitio web empleando un CMS",
        "Price": 6500.0,
        "CodeProdServ": "43232408",
        "NameCodeProdServ": "Software de desarrollo de plataformas web",
        "CuentaPredial": "123",
        "Taxes": [
            {
                "Name": "IVA",
                "Rate": 0.16,
                "IsRetention": false,
                "IsFederalTax": true
            },
            {
                "Name": "ISR",
                "IsRetention": true,
                "IsFederalTax": true,
                "Total": 0.1
            },
            {
                "Name": "IVA",
                "IsRetention": true,
                "IsFederalTax": true,
                "Total": 0.1
            }
        ]
    }
}
```
