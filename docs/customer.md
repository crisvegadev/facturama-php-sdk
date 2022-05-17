## Documentation

* [Account](account.md)
* [Customer](customer.md)
* [Invoice](invoice.md)
* [Product](product.md)

## Customer (Clients)

### Get list of all customers

For more information: [Facturama API Get Clients](https://apisandbox.facturama.mx/docs/api/GET-Client)

```php
\Crisvegadev\Facturama\Customer::getAll();
```
Example result:

*Response of type object*
```json
{
    "statusCode": 200,
    "statusMessage": "OK",
    "data": [
        {
            "Id": "-C4sT6klG1oX6193-HTN2Q2",
            "Address": {
                "Street": "",
                "ExteriorNumber": "105",
                "InteriorNumber": "",
                "Neighborhood": "",
                "ZipCode": "78216",
                "Municipality": "",
                "State": "SAN LUIS POTOSI",
                "Country": "MEXICO"
            },
            "Rfc": "XAXX010101000",
            "Name": "MARIA GUADALUPE GUERRERO RAMIREZ",
            "Email": "humbertos@facturama.mx",
            "CfdiUse": "P01"
        },
        {
            "Id": "DNiZQqp29_pjW7WR94PR9A2",
            "Address": {
                "Street": "",
                "ExteriorNumber": "302",
                "InteriorNumber": "",
                "Neighborhood": "",
                "ZipCode": "78216",
                "Municipality": "",
                "State": "SAN LUIS POTOSI",
                "Country": "MEXICO"
            },
            "Rfc": "XAXX010101000",
            "Name": "SERGIO MANUEL BERNAL GRANILLO",
            "Email": "humbertos@facturama.mx",
            "CfdiUse": "P01"
        }
    ]
}
```
### Search customers

For more information: [Facturama API Search Clients](https://apisandbox.facturama.mx/docs/api/GET-Client_keyword)

| Parameter | Type   | Required ? | 
|-----------|--------|------------|
| `keyword` | String | Yes        |

<br>

```php
\Crisvegadev\Facturama\Customer::search('keyword');
```
Example result:

*Response of type object*
```json
{
    "statusCode": 200,
    "statusMessage": "OK",
    "data": [
        {
            "Id": "-C4sT6klG1oX6193-HTN2Q2",
            "Address": {
                "Street": "",
                "ExteriorNumber": "105",
                "InteriorNumber": "",
                "Neighborhood": "",
                "ZipCode": "78216",
                "Municipality": "",
                "State": "SAN LUIS POTOSI",
                "Country": "MEXICO"
            },
            "Rfc": "XAXX010101000",
            "Name": "MARIA GUADALUPE GUERRERO RAMIREZ",
            "Email": "humbertos@facturama.mx",
            "CfdiUse": "P01"
        },
        {
            "Id": "DNiZQqp29_pjW7WR94PR9A2",
            "Address": {
                "Street": "",
                "ExteriorNumber": "302",
                "InteriorNumber": "",
                "Neighborhood": "",
                "ZipCode": "78216",
                "Municipality": "",
                "State": "SAN LUIS POTOSI",
                "Country": "MEXICO"
            },
            "Rfc": "XAXX010101000",
            "Name": "SERGIO MANUEL BERNAL GRANILLO",
            "Email": "humbertos@facturama.mx",
            "CfdiUse": "P01"
        }
    ]
}

```

### Get customer by id

For more information: [Facturama API Get Client](https://apisandbox.facturama.mx/docs/api/GET-Client-id)

| Parameter | Type   | Required ? | 
|-----------|--------|------------|
| `id`      | String | Yes        |  

<br>

```php
\Crisvegadev\Facturama\Customer::getById({id});
```
Example:

```php
\Crisvegadev\Facturama\Customer::getById("NH98VzHgdF8sFl1kFXXJ7A2");
```

*Response of type object*
```json
{
    "statusCode": 200,
    "statusMessage": "OK",
    "data": {
        "Id": "NH98VzHgdF8sFl1kFXXJ7A2",
        "Address": {
            "Street": "Av Seguridad Soc",
            "ExteriorNumber": "123",
            "InteriorNumber": "",
            "Neighborhood": "Fidel Velazquez",
            "ZipCode": "78436",
            "Locality": "",
            "Municipality": "Soledad de Graciano Sánchez",
            "State": "SAN LUIS POTOSI",
            "Country": "MEXICO"
        },
        "Rfc": "ROAM861021459",
        "Name": "Manuel Romero Alva",
        "Email": "manuelromeroalva@gmail.com",
        "CfdiUse": "P01",
        "TaxResidence": "",
        "NumRegIdTrib": ""
    }
}

```

### Create a new customer:

For more information: [Facturama API Create Client](https://apisandbox.facturama.mx/docs/api/POST-Client)

| Parameter | Type   | Required ? | 
|-----------|--------|------------|
| `data`    | array  | Yes        | 

<br>

```php
\Crisvegadev\Facturama\Customer::create({data});
```

Example:

```php
\Crisvegadev\Facturama\Customer::create([
        "Email" => "manuelromeroalva@gmail.com",
        "EmailOp1" => "",
        "EmailOp2" => "",
        "Address" => [
          "Street" => "Av Seguridad Soc",
          "ExteriorNumber" => "123",
          "InteriorNumber" => "",
          "Neighborhood" => "Fidel Velazquez",
          "ZipCode" => "78436",
          "Locality" => "",
          "Municipality" => "Soledad de Graciano Sánchez",
          "State" => "San Luis Potosí",
          "Country" => "Mex"
        ],
        "Rfc" => "ROAM861021459",
        "Name" => "Manuel Romero Alva",
        "CfdiUse" => "P01",
        "TaxResidence" => "",
        "NumRegIdTrib" => ""
]);
```

*Response of type object*

```json
{
    "statusCode": 200,
    "statusMessage": "OK",
    "data": {
        "Id": "NH98VzHgdF8sFl1kFXXJ7A2",
        "Address": {
            "Street": "Av Seguridad Soc",
            "ExteriorNumber": "123",
            "InteriorNumber": "",
            "Neighborhood": "Fidel Velazquez",
            "ZipCode": "78436",
            "Locality": "",
            "Municipality": "Soledad de Graciano Sánchez",
            "State": "SAN LUIS POTOSI",
            "Country": "MEXICO"
        },
        "Rfc": "ROAM861021459",
        "Name": "Manuel Romero Alva",
        "Email": "manuelromeroalva@gmail.com",
        "CfdiUse": "P01",
        "TaxResidence": "",
        "NumRegIdTrib": ""
    }
}

```
### Delete a customer

For more information: [Facturama API Delete Clients](https://apisandbox.facturama.mx/docs/api/DELETE-Client-id)

| Parameter | Type   | Required ? | 
|-----------|--------|------------|
| `id`      | String | Yes        |

<br>

```php
\Crisvegadev\Facturama\Customer::delete({id});
```
Example:

```php
\Crisvegadev\Facturama\Customer::delete("NH98VzHgdF8sFl1kFXXJ7A2");
```

*Response of type object*
```json
{
    "statusCode": 200,
    "statusMessage": "OK",
    "data": {
        "Id": "NH98VzHgdF8sFl1kFXXJ7A2",
        "Address": {
            "Street": "Av Seguridad Soc",
            "ExteriorNumber": "123",
            "InteriorNumber": "",
            "Neighborhood": "Fidel Velazquez",
            "ZipCode": "78436",
            "Locality": "",
            "Municipality": "Soledad de Graciano Sánchez",
            "State": "SAN LUIS POTOSI",
            "Country": "MEXICO"
        },
        "Rfc": "ROAM861021459",
        "Name": "Manuel Romero Alva",
        "Email": "manuelromeroalva@gmail.com",
        "CfdiUse": "P01",
        "TaxResidence": "",
        "NumRegIdTrib": ""
    }
}
```

### RFC Status

For more information: [Facturama API RFC Status](https://apisandbox.facturama.mx/docs/api/DELETE-Client-id)


| Parameter | Type   | Required ? | 
|-----------|--------|------------|
| `rfc`     | String | Yes        |

<br>

```php
\Crisvegadev\Facturama\Customer::rfcStatus({rfc});
```

Example:

```php
\Crisvegadev\Facturama\Customer::rfcStatus("ESO1202108R2");
```

*Response of type object*

```json
{
    "statusCode": 200,
    "statusMessage": "OK",
    "data": {
        "Rfc": "ESO1202108R2",
        "FormatoCorrecto": true,
        "Activo": true,
        "Localizado": true
    }
}
```
