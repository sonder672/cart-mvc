<?php

namespace Src\Controller\MediatorPattern;

class Mediator implements IMediator
{
    private $colleague = [];

    public function addColleague(AbstractColleague $colleague)
    {
        $this->colleague[] = $colleague;
    }

    public function send($event, string $message, AbstractColleague $colleague): void
    {
        foreach($this->colleague as $colleagues)
        {
            if ($colleagues != $colleague)
            {
                $colleagues->execute($event, $message);
            }
        }
    }
}