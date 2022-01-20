<?php

namespace Src\Shopping\Controller\Service;

use Src\Patterns\ProxyPattern\IIntermediaryControllerService;
use Src\Shopping\Model\Business\Exception\EmptyListException;

final class ShowService implements IIntermediaryControllerService
{
    public function __invoke(object $dto)
    {
        if (isset( $_SESSION[$dto->uuid()] ))
        {
            return $_SESSION[$dto->uuid()];
        }
        throw new EmptyListException('Agregue primero productos');
    }
}