<?php

declare(strict_types=1);

namespace Prometee\VIESClientBundle\Constraints;

use Prometee\VIESClient\Helper\ViesHelperInterface;
use Prometee\VIESClient\Util\VatNumberUtil;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use UnexpectedValueException;

class VatNumberValidator extends ConstraintValidator
{
    public function __construct(
        protected ViesHelperInterface $helper,
    ) {
    }

    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof VatNumber) {
            throw new UnexpectedTypeException($constraint, VatNumber::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        if (!is_string($value)) {
            throw new UnexpectedTypeException($value, 'string');
        }

        $status = $this->helper->isValid($value);
        switch ($status) {
            case ViesHelperInterface::CHECK_STATUS_INVALID_WEBSERVICE:
                $this->context->buildViolation($constraint->message)
                    ->setParameter('{{ value }}', $this->formatValue($value))
                    ->setCode($constraint::WRONG_NUMBER_ERROR)
                    ->addViolation();
                break;
            case ViesHelperInterface::CHECK_STATUS_INVALID:
                $this->context->buildViolation($constraint->message)
                    ->setParameter('{{ value }}', $this->formatValue($value))
                    ->setCode($constraint::WRONG_FORMAT_ERROR)
                    ->addViolation();
                break;
        }
    }

    protected function formatValue(mixed $value, int $format = 0): string
    {
        if (!is_string($value)) {
            throw new UnexpectedValueException(sprintf('Expect string get %s !', gettype($value)));
        }

        $value = VatNumberUtil::clean($value);

        return parent::formatValue($value, $format);
    }
}
