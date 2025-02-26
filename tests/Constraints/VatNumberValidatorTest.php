<?php

declare(strict_types=1);

namespace Tests\Prometee\VIESClientBundle\Constraints;

use PHPUnit\Framework\Attributes\DataProvider;
use Prometee\VIESClient\Helper\ViesHelper;
use Prometee\VIESClient\Soap\Client\DeferredViesSoapClient;
use Prometee\VIESClient\Soap\Client\ViesSoapClient;
use Prometee\VIESClient\Soap\Factory\ViesSoapClientFactory;
use Prometee\VIESClientBundle\Constraints\VatNumber;
use Prometee\VIESClientBundle\Constraints\VatNumberValidator;
use Symfony\Component\Validator\ConstraintValidatorInterface;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

/**
 * @extends ConstraintValidatorTestCase<VatNumberValidator>
 */
class VatNumberValidatorTest extends ConstraintValidatorTestCase
{
    protected function createValidator(): ConstraintValidatorInterface
    {
        return $this->createCustomValidator();
    }

    private function createCustomValidator(string $wsdl = null): VatNumberValidator
    {
        $viesSoapClientFactory = new ViesSoapClientFactory(ViesSoapClient::class, $wsdl);
        $soapClient = new DeferredViesSoapClient($viesSoapClientFactory);
        $helper = new ViesHelper($soapClient);

        return new VatNumberValidator($helper);
    }

    public function testNullIsValid(): void
    {
        $this->validator->validate(null, new VatNumber());

        $this->assertNoViolation();
    }

    public function testEmptyStringIsValid(): void
    {
        $this->validator->validate('', new VatNumber());

        $this->assertNoViolation();
    }

    public function testValidVatNumberWithNetworkError(): void
    {
        $wsdl = preg_replace(
            '#ec\.europa\.eu#',
            'ec.europa.eueu',
            ViesSoapClient::WSDL
        );

        $validator = $this->createCustomValidator($wsdl);

        $validator->validate('FR10632012100', new VatNumber());

        $this->assertNoViolation();
    }

    #[DataProvider('getValidVatNumbers')]
    public function testValidVatNumbers(string $number): void
    {
        $this->validator->validate($number, new VatNumber());

        $this->assertNoViolation();
    }

    public static function getValidVatNumbers(): array
    {
        //VAT number of L'Oreal
        return [
            ['FR10632012100'],
            [' FR10632012100'],
            ['FR10632012100 '],
            [' FR10632012100 '],
            ['FR 10 632012100'],
            [' FR 10 632012100 '],
            ['#FR10632012100'],
            ['FR10632012100#'],
            ['#FR10632012100#'],
            ['FR#10#632012100'],
            ['#FR#10#632012100#'],
            ['\\FR10632012100'],
            ['FR10632012100\\'],
            ['\\FR10632012100\\'],
            ['FR\\10\\632012100'],
            ['\\FR\\10\\632012100\\'],
        ];
    }

    #[DataProvider('getInvalidNumbers')]
    public function testInvalidNumbers(string $number, string $code): void
    {
        $constraint = new VatNumber([
            'message' => 'myMessage',
        ]);

        $this->validator->validate($number, $constraint);

        $this->buildViolation('myMessage')
            ->setParameter('{{ value }}', '"' . $number . '"')
            ->setCode($code)
            ->assertRaised();
    }

    public static function getInvalidNumbers(): array
    {
        return [
            ['0010632012100', VatNumber::WRONG_FORMAT_ERROR],
            ['FR12345678987', VatNumber::WRONG_NUMBER_ERROR],
        ];
    }

    #[DataProvider('getInvalidTypes')]
    public function testInvalidTypes(mixed $number): void
    {
        $this->expectException(UnexpectedTypeException::class);

        $constraint = new VatNumber();
        $this->validator->validate($number, $constraint);
    }

    public static function getInvalidTypes(): array
    {
        return [
            [0],
            [123],
            [[]],
            [new \stdClass()],
        ];
    }
}
