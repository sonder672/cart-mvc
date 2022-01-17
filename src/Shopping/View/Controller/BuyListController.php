<?php

namespace Src\Shopping\View\Controller;

use App\Controller;
use App\Eloquent\Invoice;
use App\Eloquent\Product;
use App\Eloquent\ShoppingList;
use Illuminate\Http\Request;
use Src\Invoice\Controller\Service\CreateService;
use Src\Invoice\Model\Repository\Eloquent\CreateRepository as CreateInvoiceRepository;
use Src\Patterns\MediatorPattern\Mediator;
use Src\Patterns\ProxyPattern\IntermediaryControllerService;
use Src\Product\Controller\Service\Check\CheckOutOfStockService;
use Src\Product\Controller\Service\Check\SubtractStockService;
use Src\Product\Model\Repository\Eloquent\Check\CheckStock;
use Src\Product\Model\Repository\Eloquent\Check\UpdateStockRepository;
use Src\Product\Model\Repository\Eloquent\Crud\UpdateSoldOutRepository;
use Src\Shopping\Controller\Dto\BuyDto;
use Src\Shopping\Controller\Service\Delete\DeleteAllList;
use Src\Shopping\Controller\Service\Pay\InmediatePaymentService;
use Src\Shopping\Controller\Service\RelevantInformation\SumAllProduct;
use Src\Shopping\Model\Repository\Eloquent\CreateRepository;

class BuyListController extends Controller
{
    public function buy(Request $request)
    {
        $buyDto = new BuyDto(
            $request->sessionName
        );

        $mediator = new Mediator();
        //Instancia de colegas.
        $buyService = new InmediatePaymentService(
            new CreateRepository(new ShoppingList()),
            $mediator,
            new SumAllProduct()
        );
        $createInvoice = new CreateService(
            new CreateInvoiceRepository(new Invoice()),
            $mediator
        );
        $subtractStock = new SubtractStockService(
            new UpdateStockRepository(new Product()),
            $mediator
        );
        $deleteSesion = new DeleteAllList($mediator);
        $updateSoldOut = new CheckOutOfStockService(
            new CheckStock(new Product()),
            new UpdateSoldOutRepository(new Product()),
            $mediator
        );
        //Agregar colegas al mediador.
        $mediator->addColleague($buyService);
        $mediator->addColleague($createInvoice);
        $mediator->addColleague($subtractStock);
        $mediator->addColleague($deleteSesion);
        $mediator->addColleague($updateSoldOut);
        //ProxyPattern
        $proxy = new IntermediaryControllerService($buyService);

        session_start();
        $proxy->__invoke($buyDto);

        return response()->json('purchase made');
    }
}