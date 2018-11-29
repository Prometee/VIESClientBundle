[![Build Status](https://travis-ci.org/Prometee/VIESClientBundle.svg?branch=master)](https://travis-ci.org/Prometee/VIESClientBundle)

## European VAT Information Exchange System SOAP client

This library is designed to handle validation trough VIES Soap WebService.

See http://ec.europa.eu/taxation_customs/vies/ for more information.

## Installation

Install using Composer :

```
$ composer require prometee/vies-client
```

## Usage

```php
$loader = require_once( __DIR__.'/vendor/autoload.php');

use Prometee\VIESClient\Soap\Client\ViesSoapClient;
use Prometee\VIESClient\Soap\Model\CheckVatRequest;

$checkVatRequest = new CheckVatRequest();
$checkVatRequest->setFullVatNumber('FR12345678987');

$viesSoapClient = new ViesSoapClient();
$checkVatResponse = $viesSoapClient->checkVat($checkVatRequest);

print_r($checkVatResponse);

```
