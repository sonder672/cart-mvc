<?php

namespace Src\Shopping\View\Controller;

use App\Controller;
use App\Eloquent\Product;
use App\Eloquent\SubCategory;
use Illuminate\Http\Request;
use Src\Patterns\MediatorPattern\Mediator;
use Src\Patterns\ProxyPattern\IntermediaryControllerService;
use Src\Product\Controller\Service\Check\ProductWithDiscount;
use Src\Product\Model\Repository\Eloquent\Check\CheckProductOutOfStockRepository;
use Src\Product\Model\Repository\Eloquent\Check\CheckStock;
use Src\Product\Model\Repository\Eloquent\Crud\FindRepository;
use Src\Shopping\Controller\Dto\GeneralDto;
use Src\Shopping\Controller\Service\Add\AddProductService;
use Src\Shopping\Controller\Service\Add\SumProductService;
use Src\Shopping\Controller\Service\RelevantInformation\UpdatePriceService;
use Src\Shopping\Model\Repository\Session\CreateRepository;
use Src\SubCategory\Model\Repository\Eloquent\FindByDiscount;

class AddListController extends Controller
{
    public function add(Request $request)
    {
        $addDto = new GeneralDto(
            $request->quantity,
            $request->uuid_product,
            $request->sessionName
        );

        $mediator = new Mediator();

        $discount = new ProductWithDiscount(
            new FindRepository(new Product()),
            new FindByDiscount(new SubCategory())
        );
        //Instancia colegas
        $addProduct = new AddProductService(
            new CreateRepository($request->sessionName),
            $mediator,
            $discount,
            new CheckProductOutOfStockRepository(new Product()),
            new CheckStock(new Product())
        );
        $sumProduct = new SumProductService($mediator);
        $updatePrice = new UpdatePriceService(
            $discount,
            $mediator
        );
        //Agregar colegas al mediador.
        $mediator->addColleague($addProduct);
        $mediator->addColleague($sumProduct);
        $mediator->addColleague($updatePrice);
        //Proxy
        $addProxy = new IntermediaryControllerService($addProduct);

        session_start();
        $addProxy->__invoke($addDto);      

        return response()->json( $_SESSION[$request->sessionName] );
    }
}