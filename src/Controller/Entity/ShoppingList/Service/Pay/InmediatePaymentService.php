<?php

namespace Src\Controller\Entity\ShoppingList\Service\Pay;

use Src\Controller\Entity\ShoppingList\Contract\ISumAllProduct;
use Src\Controller\GenerateUuid;
use Src\Controller\MediatorPattern\AbstractColleague;
use Src\Controller\MediatorPattern\IMediator;
use Src\Controller\ProxyPattern\IIntermediaryControllerService;
use Src\Model\Entity\ShoppingList\Contract\ICreate;
use Src\Model\Entity\ShoppingList\Exception\EmptyListException;
use Src\Model\Entity\ShoppingList\ShoppingListEntity;
use Src\Model\Entity\ShoppingList\ValueObject\QuantityValueObject;
//Pagar sin métodos de pago. Es decir, al darle click "comprará" los productos.
class InmediatePaymentService extends AbstractColleague
implements IIntermediaryControllerService
{
    private $repository;
    private $sumAll;

    public function __construct(
        ICreate $repository,
        IMediator $mediator, 
        ISumAllProduct $sumAll
        )
    {
        $this->repository = $repository;
        $this->mediator = $mediator;
        $this->sumAll = $sumAll;
    }

    public function __invoke(object $dto)
    {
        if (empty($_SESSION[$dto->sessionName()]))
        {
            throw new EmptyListException('No puede comprar sin tener artículos');
        }

        $uuid_invoice = (new GenerateUuid())->uuidv4();

        $invoiceParams = [
            'price' => $this->sumAll->__invoke($dto->sessionName()),
            'uuid' => $uuid_invoice
        ];
        //Crear recibo
        $this->mediator->send($invoiceParams, 'NeedCreateInvoice', $this);

        foreach($_SESSION[$dto->sessionName()] as $i=>$value)
        {
            $ShoppingList = new ShoppingListEntity(
                $value['price'],
                new QuantityValueObject($value['quantity']),
                $value['uuid_product'],
                $uuid_invoice
            );

            $this->repository->create($ShoppingList);
            //Restar stock
            $subtractStockParams = [
                'quantity' => $value['quantity'],
                'uuid_product' => $value['uuid_product']
            ];
            $this->mediator->send($subtractStockParams, 'NeedSubtractStock', $this);
        }
        //Eliminar sesión
        $this->mediator->send($dto, 'NeedDeleteAll', $this);
    }

    public function execute($event, string $message): void
    {
        echo 'console.log('. json_encode($message, JSON_HEX_TAG) .')';
    }
}