## Documentation

* [Account](account.md)
* [Customer](customer.md)
* [Invoice](invoice.md)
* [Product](product.md)

## Account

### Get User Info

For more information: [Facturama API Get Clients](https://apisandbox.facturama.mx/docs/api/GET-Account-UserInfo)

Example:

```php
\Crisvegadev\Facturama\Account::getUserInfo();
```

*Response of type object*
```json
{
    "UserName": "Luis",
    "Email": "humbertos@facturama.mx",
    "ContactPhone": "4448253053",
    "HasRegistered": true,
    "FiscalRegime": "601",
    "Rfc": "EKU9003173C9",
    "TaxName": "nombre12",
    "TaxAddress": {
        "Street": "FRAY JOSE DE ARLEGUIS",
        "ExteriorNumber": "abcs",
        "InteriorNumber": "L16",
        "Neighborhood": "-",
        "ZipCode": "05505",
        "Locality": "",
        "Municipality": "Mexico",
        "State": "ESTADO DE MEXICO",
        "Country": "MEXICO"
    }
}
```
### Upload LOGO

For more information: [Facturama API Search Clients](https://apisandbox.facturama.mx/docs/api/PUT-TaxEntity-UploadLogo)

| Parameter | Type   | Required? | Values allowed    |
|-----------|--------|-----------|-------------------|
| `Image`   | String | Required  | `url` or `base64` |
| `Type`    | String | Optional  |                   |

<br>

Example:

```php
\Crisvegadev\Facturama\Account::uploadLogo("http://Facturama.mx/Files/Logos/AAA010101AAA-180118153149.png", "png);
```

*Response of type object*
```json
{
    "statusCode": 204,
    "statusMessage": "OK",
    "data": "No Content"
}
```

### Upload CSD

For more information: [Facturama API Get Client](https://apisandbox.facturama.mx/docs/api/PUT-TaxEntity-UploadCsd)

| Parameter            | Type   | Required ? | Values allowed |
|----------------------|--------|------------|----------------|
| `certificateFile`    | String | Required   | `base64`       |
| `privateKeyFile`     | String | Required   | `base64`       |
| `privateKeyPassword` | String | Required   |                |

<br>

```php
\Crisvegadev\Facturama\Customer::uploadCSD({certificateFile}, {privateKeyFile}, {privateKeyPassword});
```
Example:

```php
\Crisvegadev\Facturama\Customer::getById("AAA010101AAAManuel__CSD.cer", "AAA010101AAAManuel__CSD.key", "12345678a");
```

*Response of type object*
```json
{
    "statusCode": 204,
    "statusMessage": "OK",
    "data": "No Content"
}
```

### Get TaxEntity (Fiscal Information)

For more information: [Facturama API Create Client](https://apisandbox.facturama.mx/docs/api/GET-TaxEntity)

```php
\Crisvegadev\Facturama\Customer::getTaxEntity();
```

*Response of type object*

```json
{
    "FiscalRegime": "601",
    "ComercialName": "DECSAS111",
    "Rfc": "EKU9003173C9",
    "TaxName": "nombre12",
    "Email": "humbertos@facturama.mx",
    "Phone": "4448253053",
    "TaxAddress": {
        "Street": "FRAY JOSE DE ARLEGUIS",
        "ExteriorNumber": "abcs",
        "InteriorNumber": "L16",
        "Neighborhood": "-",
        "ZipCode": "05505",
        "Locality": "",
        "Municipality": "Mexico",
        "State": "ESTADO DE MEXICO",
        "Country": "MEXICO"
    },
    "IssuedIn": {
        "Street": "street ex",
        "ExteriorNumber": "extnum ex",
        "InteriorNumber": "interior number ex",
        "Neighborhood": "neighborhood ex",
        "ZipCode": "12345",
        "Locality": "localitty ex",
        "Municipality": "city ex",
        "State": "NUEVO LEON",
        "Country": "MEXICO"
    },
    "Csd": {
        "Certificate": "AAA010101AAAPruebas__CSD.cer",
        "PrivateKey": "AAA010101AAAPruebas__CSD.key",
        "PrivateKeyPassword": "12345678a"
    },
    "UrlLogo": "http://Facturama.mx/Files/Logos/AAA010101AAA-180118153149.png"
}
```
### Update TaxEntity (Fiscal Information)

For more information: [Facturama API Delete Clients](https://apisandbox.facturama.mx/docs/api/DELETE-Client-id)

| Parameter | Type   | Required ? | 
|-----------|--------|------------|
| `data`    | String | Yes        |

<br>

```php
\Crisvegadev\Facturama\Customer::updateTaxEntity({data});
```
Example:

```php
\Crisvegadev\Facturama\Customer::updateTaxEntity([
   "FiscalRegime" => "601",
  "ComercialName" => "DECSAS111",
  "Rfc" => "EKU9003173C9",
  "TaxName" => "nombre12",
  "Email" => "humbertos@facturama.mx",
  "Phone" => "4448253053",
  "TaxAddress" => [
    "Street" => "FRAY JOSE DE ARLEGUIS",
    "ExteriorNumber" => "203",
    "InteriorNumber" => "L16",
    "Neighborhood" => "-",
    "ZipCode" => "05505",
    "Locality" => "",
    "Municipality" => "Mexico",
    "State" => "ESTADO DE MEXICO",
    "Country" => "MEXICO"
  ]
]);
```

*Response of type object*
```json
{
    "statusCode": 204,
    "statusMessage": "OK",
    "data": "No Content"
}
```

### Get Suscription Plan

For more information: [Facturama API Delete Clients](https://apisandbox.facturama.mx/docs/api/GET-SuscriptionPlan)

```php
\Crisvegadev\Facturama\Customer::getSuscriptionPlan();
```

*Response of type object*
```json
{
    "Plan": "sample string 1",
    "CurrentFolios": "sample string 2",
    "CreationDate": "2022-03-22T15:46:41.6693857-06:00",
    "ExpirationDate": "2022-03-22T15:46:41.6693857-06:00",
    "Amount": 1.0,
    "Id": "sample string 5"
}
```
