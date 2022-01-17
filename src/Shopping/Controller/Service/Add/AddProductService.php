<?php

namespace Src\Shopping\Controller\Service\Add;

use Src\Patterns\MediatorPattern\AbstractColleague;
use Src\Patterns\MediatorPattern\IMediator;
use Src\Patterns\ProxyPattern\IIntermediaryControllerService;
use Src\Product\Controller\Contract\IDiscount;
use Src\Product\Model\Business\Contract\Check\ICheckProductOutOfStock;
use Src\Product\Model\Business\Contract\Check\ICheckStock;
use Src\Product\Model\Business\Exception\SoldOutException;
use Src\Shopping\Model\Business\Contract\ICreate;
use Src\Shopping\Model\Business\ShoppingListEntity;
use Src\Shopping\Model\Business\ValueObject\QuantityValueObject;

final class AddProductService extends AbstractColleague
implements IIntermediaryControllerService
{
    private $repository;
    private $discount;
    private $soldOut;
    private $stock;

    public function __construct(
        ICreate $repository, 
        IMediator $mediator,
        IDiscount $discount,
        ICheckProductOutOfStock $soldOut,
        ICheckStock $stock
        )
    {
        $this->repository = $repository;
        $this->mediator = $mediator;
        $this->discount = $discount;
        $this->soldOut = $soldOut;
        $this->stock = $stock;
    }   

    public function __invoke(object $dto)
    {
        //Verificación si el producto no está agotado o si la suma de
        //la cantidad deseada no supera el stock actual.
        if ($this->soldOut->soldOut($dto->uuid_product()) == 1 || 
            $dto->quantity() > $this->stock->stock($dto->uuid_product()))
        {  
            throw new SoldOutException('No puede agregar esta cantidad de productos (agotado)');         
        }

        if ($this->uuidProductExist($dto) == true)
        {
            //Evento suma cantidad.
            $this->mediator->send($dto, 'NeedSumProduct', $this);

            return $_SESSION[$dto->sessionName()];
        }          

        $list = new ShoppingListEntity(
            ($this->discount->productWithDiscount(
                $dto->uuid_product()
                ) * $dto->quantity()),
            new QuantityValueObject($dto->quantity()),
            $dto->uuid_product(),
            null
        ); 
        //crear en la sesión.
        $this->repository->create($list);
    } 

    private function uuidProductExist(object $dto)
    {
        if (isset($_SESSION[$dto->sessionName()]))
        {
            foreach ($_SESSION[$dto->sessionName()] as $i=>$product) 
            {                               
            //Validación de si el producto ingresado ya se encuentra en el carrito.
                if ($product['uuid_product'] == $dto->uuid_product()) 
                {
                    //Suma de quantity existente con la quantity nueva.
                    if ($product['quantity'] + $dto->quantity() 
                        > $this->stock->stock($dto->uuid_product()))
                    {
                        throw new SoldOutException('No puede agregar esta cantidad de productos (agotado)');
                    }
                    return true;
                }
            }
        }
        return false;
    }

    public function execute($event, string $message): void
    {
        echo 'console.log('. json_encode($message, JSON_HEX_TAG) .')';
    }
}