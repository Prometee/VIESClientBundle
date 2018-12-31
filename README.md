[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE)
[![Build Status][ico-travis]][link-travis]
[![Quality Score][ico-code-quality]][link-code-quality]

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

[ico-version]: https://img.shields.io/packagist/v/Prometee/vies-client-bundle.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/Prometee/VIESClientBundle/master.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/Prometee/VIESClientBundle.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/prometee/vies-client-bundle
[link-travis]: https://travis-ci.org/Prometee/VIESClientBundle
[link-scrutinizer]: https://scrutinizer-ci.com/g/Prometee/VIESClientBundle/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/Prometee/VIESClientBundle
