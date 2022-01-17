<?php

namespace Src\Product\Controller\Service\Check;

use Src\Patterns\MediatorPattern\AbstractColleague;
use Src\Patterns\MediatorPattern\IMediator;
use Src\Product\Model\Business\Contract\Check\ICheckStock;
use Src\Product\Model\Business\Contract\Crud\IUpdateSoldOut;

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