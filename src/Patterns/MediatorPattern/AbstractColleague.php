<?php

namespace Src\Patterns\MediatorPattern;

abstract class AbstractColleague
{
    protected $mediator;

    public function __construct(IMediator $mediator)
    {
        $this->mediator = $mediator;
    }

    abstract public function execute($event, string $message): void;
}