<?php

namespace App\Event;

use App\Dto\Command;
use Symfony\Contracts\EventDispatcher\Event;

final class ApplyEvent extends Event
{
    private $command;

    public function __construct(Command $command)
    {
        $this->command = $command;
    }

    public function getCommand(): Command
    {
        return $this->command;
    }
}
