## Invoice

### Create a invoice

For more information: [Facturama API Create Invoice](https://apisandbox.facturama.mx/docs/api/POST-2-cfdis)

| Parameter | Type   | Required? | 
|-----------|--------|-----------|
| `data`    | Array  | Yes       |  

<br>

```php
\Crisvegadev\Facturama\Invoice::create({data});
```

Example:

```php
    \Crisvegadev\Facturama\Invoice::create([
        "Serie" => "R",
        "Currency" => "MXN",
        "ExpeditionPlace" => "78116",
        "PaymentConditions" => "CREDITO A SIETE DIAS",
        "Folio" => "100",
        "CfdiType" => "I",
        "PaymentForm" => "03",
        "PaymentMethod" => "PUE",
        "Receiver" => [
            "Rfc" => "RSS2202108U5",
            "Name" => "RADIAL SOFTWARE SOLUTIONS",
            "CfdiUse" => "P01"
        ],
        "Items" => [
            [
                "ProductCode" => "10101504",
                "IdentificationNumber" => "EDL",
                "Description" => "Estudios de viabilidad",
                "Unit" => "NO APLICA",
                "UnitCode" => "MTS",
                "UnitPrice" => 50.0,
                "Quantity" => 2.0,
                "Subtotal" => 100.0,
                "Taxes" => [
                    [
                        "Total" => 16.0,
                        "Name" => "IVA",
                        "Base" => 100.0,
                        "Rate" => 0.16,
                        "IsRetention" => false
                    ]
                ],
                "Total" => 116.0
            ],
            [
                "ProductCode" => "10101504",
                "IdentificationNumber" => "001",
                "Description" => "SERVICIO DE COLOCACION",
                "Unit" => "NO APLICA",
                "UnitCode" => "E49",
                "UnitPrice" => 100.0,
                "Quantity" => 15.0,
                "Subtotal" => 1500.0,
                "Discount" => 0.0,
                "Taxes" => [
                    [
                      "Total" => 240.0,
                      "Name" => "IVA",
                      "Base" => 1500.0,
                      "Rate" => 0.16,
                      "IsRetention" => false
                    ]
              ],
              "Total" => 1740.0
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
        "Id": "7eo51BvzV-E16gBx3nnxfQ2",
        "CfdiType": "ingreso",
        "Serie": "R",
        "Folio": "1",
        "Date": "2018-02-27T10:46:19",
        "PaymentTerms": "03 - Transferencia electrónica de fondos",
        "PaymentConditions": "CREDITO A SIETE DIAS",
        "PaymentMethod": "PUE - Pago en una sola exhibición",
        "ExpeditionPlace": "78116",
        "ExchangeRate": 0.0,
        "Currency": "MXN - Peso Mexicano",
        "Subtotal": 1600.0,
        "Discount": 0.0,
        "Total": 1856.0,
        "Observations": "",
        "Issuer": {
            "FiscalRegime": "601 - General de Ley Personas Morales",
            "Rfc": "ESO1202108R2",
            "TaxName": "EXPRESION EN SOFTWARE"
        },
        "Receiver": {
            "Rfc": "RSS2202108U5",
            "Name": "RADIAL SOFTWARE SOLUTIONS"
        },
        "Items": [
            {
                "Discount": 0.0,
                "Quantity": 2.0,
                "Unit": "E49 - NO APLICA",
                "Description": "Estudios de viabilidad",
                "UnitValue": 50.0,
                "Total": 100.0
            },
            {
                "Discount": 0.0,
                "Quantity": 15.0,
                "Unit": "E49 - NO APLICA",
                "Description": "SERVICIO DE COLOCACION",
                "UnitValue": 100.0,
                "Total": 1500.0
            }
        ],
        "Taxes": [
            {
                "Total": 256.0,
                "Name": "IVA",
                "Rate": 16.0,
                "Type": "transferred"
            }
        ],
        "Complement": {
            "TaxStamp": {
                "Uuid": "215CEC43-7E57-44AC-9D63-B54BBC4745BD",
                "Date": "2018-02-27T10:46:23",
                "CfdiSign": "EFirmqT9Ig9BYKPEN5NsaCv7mwAidt...eCsmPuMoCAUzhGRVdijRHr4cxVhhMfTw==",
                "SatCertNumber": "20001000000300022323",
                "SatSign": "Go3Q/iFSVFKw9qohv3R7g+cRJxNT...kHdB7Q2Q0zKv4tjbbXPIK7nr64kCEBvi2rpg==",
                "RfcProvCertif": "FLI081010EK2"
            }
        }
    }
}

```

### Get invoice by id and type

For more information: [Facturama API Get Invoice](https://apisandbox.facturama.mx/docs/api/GET-Cfdi-id_type)

| Parameter | Type          | Required ? | Values allowed            |
|-----------|---------------|------------|---------------------------|
| `id`      | String        | Yes        |                           |
| `type`    | InvoiceStatus | Yes        | issued, received, payroll |

<br>

```php
\Crisvegadev\Facturama\Invoice::get({id}, {type});
```

Example:

```php
\Crisvegadev\Facturama\Invoice::get("NH98VzHgdF8sFl1kFXXJ7A2", InvoiceStatus::issued);
```

*Response of type object*
```json
{
    "statusCode": 200,
    "statusMessage": "OK",
    "data": {
        "Id": "7eo51BvzV-E16gBx3nnxfQ2",
        "CfdiType": "ingreso",
        "Serie": "R",
        "Folio": "1",
        "Date": "2018-02-27T10:46:19",
        "PaymentTerms": "03 - Transferencia electrónica de fondos",
        "PaymentConditions": "CREDITO A SIETE DIAS",
        "PaymentMethod": "PUE - Pago en una sola exhibición",
        "ExpeditionPlace": "78116",
        "ExchangeRate": 0.0,
        "Currency": "MXN - Peso Mexicano",
        "Subtotal": 1600.0,
        "Discount": 0.0,
        "Total": 1856.0,
        "Observations": "",
        "Issuer": {
            "FiscalRegime": "601 - General de Ley Personas Morales",
            "Rfc": "ESO1202108R2",
            "TaxName": "EXPRESION EN SOFTWARE"
        },
        "Receiver": {
            "Rfc": "RSS2202108U5",
            "Name": "RADIAL SOFTWARE SOLUTIONS"
        },
        "Items": [
            {
                "Discount": 0.0,
                "Quantity": 2.0,
                "Unit": "E49 - NO APLICA",
                "Description": "Estudios de viabilidad",
                "UnitValue": 50.0,
                "Total": 100.0
            },
            {
                "Discount": 0.0,
                "Quantity": 15.0,
                "Unit": "E49 - NO APLICA",
                "Description": "SERVICIO DE COLOCACION",
                "UnitValue": 100.0,
                "Total": 1500.0
            }
        ],
        "Taxes": [
            {
                "Total": 256.0,
                "Name": "IVA",
                "Rate": 16.0,
                "Type": "transferred"
            }
        ],
        "Complement": {
            "TaxStamp": {
                "Uuid": "215CEC43-7E57-44AC-9D63-B54BBC4745BD",
                "Date": "2018-02-27T10:46:23",
                "CfdiSign": "EFirmqT9Ig9BYKPEN5NsaCv7mwAidt...eCsmPuMoCAUzhGRVdijRHr4cxVhhMfTw==",
                "SatCertNumber": "20001000000300022323",
                "SatSign": "Go3Q/iFSVFKw9qohv3R7g+cRJxNT...kHdB7Q2Q0zKv4tjbbXPIK7nr64kCEBvi2rpg==",
                "RfcProvCertif": "FLI081010EK2"
            }
        }
    }
}
```
### Download the pdf file

For more information: [Facturama API Download Invoice](https://apisandbox.facturama.mx/docs/api/GET-Cfdi-format-type-id)

### Parameters

| Parameter | Type             | Required ? | Values allowed            |
|-----------|------------------|------------|---------------------------|
| `format`  | InvoiceFileTypes | Yes        | pdf, xml, html            |
| `type`    | InvoiceStatus    | Yes        | issued, received, payroll |
| `id`      | String           | Yes        |                           |

<br>

```php
\Crisvegadev\Facturama\Invoice::downloadFile({format}, {type}, {id});
```

Example:

```php
\Crisvegadev\Facturama\Invoice::downloadFile(InvoiceFileTypes::pdf, InvoiceStatus::issued, "7eo51BvzV-E16gBx3nnxfQ2");
```
