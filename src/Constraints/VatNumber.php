<?php

declare(strict_types=1);

namespace Prometee\VIESClientBundle\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class VatNumber extends Constraint
{
    public const WRONG_FORMAT_ERROR = '500';
    public const WRONG_NUMBER_ERROR = '404';

    /** @var string[] */
    protected static $errorNames = [
        self::WRONG_FORMAT_ERROR => 'WRONG_FORMAT_ERROR',
        self::WRONG_NUMBER_ERROR => 'WRONG_NUMBER_ERROR',
    ];

    /** @var string */
    public $message = 'prometee_vies_client.vat_number.invalid';
}
