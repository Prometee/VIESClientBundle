<?php

declare(strict_types=1);

namespace Prometee\VIESClientBundle\Constraints;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class VatNumber extends Constraint
{
    /** @var string */
    public const WRONG_FORMAT_ERROR = '500';

    /** @var string */
    public const WRONG_NUMBER_ERROR = '404';

    /** @var string[] */
    protected static array $errorNames = [
        self::WRONG_FORMAT_ERROR => 'WRONG_FORMAT_ERROR',
        self::WRONG_NUMBER_ERROR => 'WRONG_NUMBER_ERROR',
    ];

    public string $message = 'prometee_vies_client.vat_number.invalid';
}
