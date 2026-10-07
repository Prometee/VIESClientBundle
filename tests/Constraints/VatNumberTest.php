<?php

declare(strict_types=1);

namespace Tests\Prometee\VIESClientBundle\Constraints;

use PHPUnit\Framework\TestCase;
use Prometee\VIESClientBundle\Constraints\VatNumber;

class VatNumberTest extends TestCase
{
    public function testDefaults(): void
    {
        $constraint = new VatNumber();

        self::assertSame('prometee_vies_client.vat_number.invalid', $constraint->message);
        self::assertSame(['Default'], $constraint->groups);
        self::assertNull($constraint->payload);
    }

    public function testNamedArguments(): void
    {
        $constraint = new VatNumber(message: 'myMessage', groups: ['custom'], payload: 'payload');

        self::assertSame('myMessage', $constraint->message);
        self::assertSame(['custom'], $constraint->groups);
        self::assertSame('payload', $constraint->payload);
    }
}
