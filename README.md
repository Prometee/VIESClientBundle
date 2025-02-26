[![Latest Version on Packagist][ico-version]][link-packagist]
[![Build Status][ico-github-actions]][link-github-actions]
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
     #[VatNumber(message: "My custom error message")]
    private $vatNumber;
}

```

[ico-version]: https://img.shields.io/packagist/v/Prometee/vies-client-bundle.svg?style=flat-square
[ico-github-actions]: https://github.com/Prometee/VIESClientBundle/workflows/Build/badge.svg
[ico-code-quality]: https://img.shields.io/scrutinizer/g/Prometee/VIESClientBundle.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/prometee/vies-client-bundle
[link-github-actions]: https://github.com/Prometee/VIESClientBundle/actions?query=workflow%3A"Build"
[link-scrutinizer]: https://scrutinizer-ci.com/g/Prometee/VIESClientBundle/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/Prometee/VIESClientBundle
