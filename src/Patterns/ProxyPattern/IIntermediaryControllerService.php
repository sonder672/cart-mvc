<?php

namespace Src\Patterns\ProxyPattern;

interface IIntermediaryControllerService
{
    public function __invoke(object $dto);
}
