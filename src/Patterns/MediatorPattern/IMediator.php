<?php

namespace Src\Patterns\MediatorPattern;

interface IMediator
{
    public function send($event, string $message, AbstractColleague $colleague): void;
}