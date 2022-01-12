<?php

namespace Src\Controller\Entity\ShoppingList\Service\Add;

use Src\Controller\MediatorPattern\AbstractColleague;
use Src\Controller\MediatorPattern\IMediator;
use Src\Controller\ProxyPattern\IIntermediaryControllerService;
use Src\Model\Entity\Product\Contract\IFind;
use Src\Model\Entity\ShoppingList\Contract\ICreate;
use Src\Model\Entity\ShoppingList\ShoppingListEntity;
use Src\Model\Entity\ShoppingList\ValueObject\QuantityValueObject;

final class AddProductService extends AbstractColleague
implements IIntermediaryControllerService
{
    private $repository;
    private $findProduct;

    public function __construct(
        ICreate $repository, 
        IFind $findProduct, 
        IMediator $mediator
        )
    {
        $this->repository = $repository;
        $this->findProduct = $findProduct;
        $this->mediator = $mediator;
    }   

    public function __invoke(object $dto)
    {
        if (isset($_SESSION[$dto->sessionName()]))
        {
            if ($this->uuidProductExist(
                $dto->sessionName(),
                $dto->uuid_product()
                ) == true)
            {
                $this->mediator->send($dto, 'NeedSumProduct', $this);

                return $_SESSION[$dto->sessionName()];
            }          
        }
        $findProduct = $this->findProduct->findOrFail(
            $dto->uuid_product()
        );

        $list = new ShoppingListEntity(
            ($findProduct->price * $dto->quantity()),
            new QuantityValueObject($dto->quantity()),
            $dto->uuid_product(),
            null
        ); 

        $this->repository->create($list);
    } 

    private function uuidProductExist($sessionName, $uuid_product)
    {
        foreach ($_SESSION[$sessionName] as $i=>$product) 
        {                               
            //Validación de si el producto ingresado ya se encuentra en el carrito.
            if ($product['uuid_product'] == $uuid_product) 
            {
                return true;
            }
        }
    }

    public function execute($event, string $message): void
    {
        echo 'console.log('. json_encode($message, JSON_HEX_TAG) .')';
    }
}