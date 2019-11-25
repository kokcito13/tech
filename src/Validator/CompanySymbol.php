<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class CompanySymbol extends Constraint
{
    public $message = 'Company with symbols "{{ value }}" not find in list.';
}
