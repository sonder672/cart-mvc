<?php

namespace Src\Shopping\Controller\Service\RelevantInformation;

use Src\Patterns\MediatorPattern\AbstractColleague;
use Src\Patterns\MediatorPattern\IMediator;
use Src\Product\Controller\Contract\IDiscount;

class UpdatePriceService extends AbstractColleague
{
    private $discount;

    public function __construct(IDiscount $findProduct, IMediator $mediator)
    {
        $this->discount = $findProduct;
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
        $quantity = $_SESSION[$updateParams['sessionName']]
        [$updateParams['positionCart']]['quantity'];

        $_SESSION[$updateParams['sessionName']]
        [$updateParams['positionCart']]['price'] = 
        ($this->discount->productWithDiscount(
             $updateParams['uuid_product'] 
             ) * $quantity);

        $this->mediator->send(null, 'done', $this);
    }  
}