<?php

namespace Src\Shopping\Controller\Service\Pay;

use Src\Patterns\GenerateUuid;
use Src\Patterns\MediatorPattern\AbstractColleague;
use Src\Patterns\MediatorPattern\IMediator;
use Src\Patterns\ProxyPattern\IIntermediaryControllerService;
use Src\Shopping\Controller\Contract\ISumAllProduct;
use Src\Shopping\Model\Business\Contract\ICreate;
use Src\Shopping\Model\Business\Exception\EmptyListException;
use Src\Shopping\Model\Business\ShoppingListEntity;
use Src\Shopping\Model\Business\ValueObject\QuantityValueObject;

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