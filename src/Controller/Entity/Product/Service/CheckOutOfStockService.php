<?php

namespace Src\Controller\Entity\Product\Service;

use Src\Controller\MediatorPattern\AbstractColleague;
use Src\Controller\MediatorPattern\IMediator;
use Src\Model\Entity\Product\Contract\ICheckStock;
use Src\Model\Entity\Product\Contract\IUpdateSoldOut;

class CheckOutOfStockService extends AbstractColleague
{
    private $stock;
    private $updateSoldOut;

    public function __construct(
        ICheckStock $stock, 
        IUpdateSoldOut $updateSoldOut,
        IMediator $mediator
        )
    {
        $this->stock = $stock;
        $this->updateSoldOut = $updateSoldOut;
        $this->mediator = $mediator;
    }

    public function execute($event, string $message): void
    {
        if ($message == 'CheckStock')
        {
            $this->__invoke($event);
            echo 'console.log('. json_encode($message, JSON_HEX_TAG) .')';
        }
    }

    private function __invoke($uuid_product)
    {
        if ($this->stock->stock($uuid_product) == 0)
        {
            $this->updateSoldOut->updateSoldOut($uuid_product);
        }
    }
}