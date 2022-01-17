<?php

namespace Src\Shopping\Controller\Service\Delete;

use Src\Patterns\MediatorPattern\AbstractColleague;
use Src\Patterns\ProxyPattern\IIntermediaryControllerService;

class DeleteAllList extends AbstractColleague
implements IIntermediaryControllerService
{
    public function __invoke(object $dto)
    {
        if (!empty($_SESSION[$dto->sessionName()])) 
        {
            unset($_SESSION[$dto->sessionName()]);
        }
    }

    public function execute($event, string $message): void
    {
        echo 'console.log('. json_encode($message, JSON_HEX_TAG) .')';
        if ($message == 'NeedDeleteAll')
        {
            $this->__invoke($event);
        }
    }
}