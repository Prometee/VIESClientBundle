[![Build Status](https://travis-ci.org/Prometee/VIESClientBundle.svg?branch=master)](https://travis-ci.org/Prometee/VIESClientBundle)

## European VAT Information Exchange System SOAP client

This library is designed to handle validation trough VIES Soap WebService.

See http://ec.europa.eu/taxation_customs/vies/ for more information.

## Installation

Install using Composer :

```
$ composer require prometee/vies-client-bundle
```

## Usage

Use it as a validation constraint in an `Entity` or a `Model` class.  
You can also use it as a `FormType` field constraint.

```php

use Prometee\VIESClientBundle\Constraints\VatNumber;

class User
{
    /**
     * @VatNumber(message="My custom error message")
     **/
    private $vatNumber;
}

```
