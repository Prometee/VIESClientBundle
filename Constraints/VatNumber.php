<?php

declare(strict_types=1);

namespace Prometee\VIESClientBundle\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class VatNumber extends Constraint
{
    const WRONG_FORMAT_ERROR = '500';
    const WRONG_NUMBER_ERROR = '404';

    protected static $errorNames = [
        self::WRONG_FORMAT_ERROR => 'WRONG_FORMAT_ERROR',
        self::WRONG_NUMBER_ERROR => 'WRONG_NUMBER_ERROR',
    ];

    public $message = 'prometee_vies_client.vat_number.invalid';
}
