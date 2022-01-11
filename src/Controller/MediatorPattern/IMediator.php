<?php

namespace Src\Controller\MediatorPattern;

interface IMediator
{
    public function send($event, string $message, AbstractColleague $colleague): void;
}