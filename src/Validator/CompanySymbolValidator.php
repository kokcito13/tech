<?php

namespace App\Validator;

use App\Service\GetCompanySymbols;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

final class CompanySymbolValidator extends ConstraintValidator
{
    /**
     * @var GetCompanySymbols
     */
    private $getCompanySymbols;

    public function __construct(GetCompanySymbols $getCompanySymbols)
    {
        $this->getCompanySymbols = $getCompanySymbols;
    }

    public function validate($value, Constraint $constraint)
    {
        if (null === $value || '' === $value) {
            return;
        }

        if (!in_array($value, $this->getCompanySymbols->get())) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }
    }
}
