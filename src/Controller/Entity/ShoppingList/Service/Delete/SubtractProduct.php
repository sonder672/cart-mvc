<?php

namespace Src\Controller\Entity\ShoppingList\Service\Delete;

use Src\Controller\MediatorPattern\AbstractColleague;
use Src\Controller\ProxyPattern\IIntermediaryControllerService;
use Src\Model\Entity\ShoppingList\Exception\QuantityException;

class SubtractProduct extends AbstractColleague
implements IIntermediaryControllerService
{
    public function execute($event, string $message): void
    {
        echo 'console.log('. json_encode($message, JSON_HEX_TAG) .')';
    }

    public function __invoke(object $dto)
    {
        foreach ($_SESSION[$dto->sessionName()] as $i=>$product) 
        {
            if ($product['uuid_product'] == $dto->uuid_product())
            {
                $quantity = $this->checkQuantity(
                    $dto->sessionName(),
                    $dto->quantity(),
                    $i
                );

                if (($product['quantity'] - $quantity) < 1) 
                {
                    $this->mediator->send($dto, 'NeedRemoveProduct', $this);
                    break;
                }
                $_SESSION[$dto->sessionName()][$i]['quantity'] = 
                $product['quantity'] - $quantity;

                $updatePriceParams = array(
                'sessionName' => $dto->sessionName(),
                'positionCart' => $i,
                'uuid_product' => $dto->uuid_product()
                );

                $this->mediator->send(
                    $updatePriceParams, 
                    'NeedUpdatePrice', 
                    $this
                );
                break;
            }             
        }      
    }

    private function checkQuantity($sessionName, $quantity, $i)
    {
        if ($_SESSION[$sessionName][$i]['quantity'] < $quantity)
        {
            throw new QuantityException('Cantidad errónea');
        }
        return $quantity;
    }
}