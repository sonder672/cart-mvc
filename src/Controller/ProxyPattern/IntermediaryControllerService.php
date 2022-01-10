<?php

namespace Src\Controller\ProxyPattern;

final class IntermediaryControllerService implements IIntermediaryControllerService
{
    private $service;

    public function __construct(IIntermediaryControllerService $service)
    {
        $this->service = $service;
    }

    public function __invoke(object $dto)
    {
        return $this->service->__invoke($dto);
    }
}