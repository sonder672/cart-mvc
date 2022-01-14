<?php

namespace Src\Controller\Entity\ShoppingList\Service\Add;

use Src\Controller\MediatorPattern\AbstractColleague;
use Src\Model\Entity\ShoppingList\Exception\QuantityException;

final class SumProductService extends AbstractColleague
{
    public function execute($event, string $message): void
    {
        if ($message == 'NeedSumProduct')
        {
            $this->sumProduct($event);
            echo 'console.log('. json_encode($message, JSON_HEX_TAG) .')';
        }
    }

    private function sumProduct(object $dto)
    {
        //Verificación suma de TODOS Los productos menor a 20 y máxima cantidad
        //por producto de solo 5.

        if ( ($this->quantityProducts($dto->sessionName()) + $dto->quantity() ) 
                < 21 && $this->ProductExist($dto)[1] < 6) 
        { 
            $_SESSION[$dto->sessionName()]
            [$this->ProductExist($dto)[0]]['quantity'] =
            $this->ProductExist($dto)[1];

            $updatePriceParams = array(
                'sessionName' => $dto->sessionName(),
                'positionCart' => $this->ProductExist($dto)[0],
                'uuid_product' => $dto->uuid_product()
            );

            $this->mediator->send($updatePriceParams, 'NeedUpdatePrice', $this); 
        }
        else 
        {
            throw new QuantityException('El producto agregado excede el límite');
        } 
    }

    private function ProductExist(object $dto)
    {
        foreach ($_SESSION[$dto->sessionName()] as $i=>$product) 
        {                               
            //Validación de si el producto ingresado ya se encuentra en el carrito.
            if ($product['uuid_product'] == $dto->uuid_product()) 
            {
                $quantityProduct = ($product['quantity'] + $dto->quantity()); 
                return array($i, $quantityProduct);                     
            }         
        }
        return false; 
    }

    private function quantityProducts($sessionName) 
    {
        $sumQuantities = 0;
        foreach ($_SESSION[$sessionName] as $i=>$product) 
        {                  
            //Suma total de la cantidad elegida en cada producto.
            $sumQuantities += ($product['quantity']); 
        } 
        return $sumQuantities;
    }  
}