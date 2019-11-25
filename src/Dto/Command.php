<?php
declare(strict_types=1);

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

final class Command
{
    /**
     * @Assert\NotBlank
     * @\App\Validator\CompanySymbol()
     */
    public $companySymbol;

    /**
     * @Assert\NotBlank
     * @Assert\Regex("/^([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))$/")
     */
    public $dateStart;

    /**
     * @Assert\NotBlank
     * @Assert\Regex("/^([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))$/")
     */
    public $dateEnd;

    /**
     * @Assert\Email
     * @Assert\NotBlank
     */
    public $email;
}
