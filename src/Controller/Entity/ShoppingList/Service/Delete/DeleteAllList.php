<?php

namespace Src\Controller\Entity\ShoppingList\Service\Delete;

use Src\Controller\MediatorPattern\AbstractColleague;
use Src\Controller\ProxyPattern\IIntermediaryControllerService;

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