<?php

namespace Src\Controller\Entity\ShoppingList\Service;

use Src\Controller\MediatorPattern\AbstractColleague;
use Src\Controller\MediatorPattern\IMediator;
use Src\Model\Entity\Product\Contract\IFind;

class UpdatePriceService extends AbstractColleague
{
    private $findProduct;

    public function __construct(IFind $findProduct, IMediator $mediator)
    {
        $this->findProduct = $findProduct;
        $this->mediator = $mediator;
    }

    public function execute($event, string $message): void
    {
        if ($message == 'NeedUpdatePrice')
        {
            $this->updatePrice($event);
            echo 'console.log('. json_encode($message, JSON_HEX_TAG) .')';
        }
    }

    public function updatePrice($updateParams)
    {
        $findProduct = $this->findProduct->findOrFail(
            $updateParams['uuid_product']
        );

        $quantity = $_SESSION[$updateParams['sessionName']]
        [$updateParams['positionCart']]['quantity'];

        $_SESSION[$updateParams['sessionName']]
        [$updateParams['positionCart']]['price'] = 
        ($findProduct->price * $quantity);

        $this->mediator->send(null, 'done', $this);
    }  
}