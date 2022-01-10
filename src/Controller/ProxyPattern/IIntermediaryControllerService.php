<?php

namespace Src\Controller\ProxyPattern;

interface IIntermediaryControllerService
{
    public function __invoke(object $dto);
}
