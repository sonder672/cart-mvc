<?php

namespace Src\Shopping\View\Controller;

use App\Controller;
use App\Eloquent\Product;
use App\Eloquent\SubCategory;
use Illuminate\Http\Request;
use Src\Patterns\MediatorPattern\Mediator;
use Src\Patterns\ProxyPattern\IntermediaryControllerService;
use Src\Product\Controller\Service\Check\ProductWithDiscount;
use Src\Product\Model\Repository\Eloquent\Crud\FindRepository;
use Src\Shopping\Controller\Dto\DeleteAllListDto;
use Src\Shopping\Controller\Dto\DeleteAllProductDto;
use Src\Shopping\Controller\Dto\GeneralDto;
use Src\Shopping\Controller\Service\Delete\DeleteAllList;
use Src\Shopping\Controller\Service\Delete\DeleteAllProduct;
use Src\Shopping\Controller\Service\Delete\SubtractProduct;
use Src\Shopping\Controller\Service\RelevantInformation\UpdatePriceService;
use Src\SubCategory\Model\Repository\Eloquent\FindByDiscount;

class DeleteListController extends Controller
{
    public function subtractProduct(Request $request)
    {
        $subtractDto = new GeneralDto(
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
        $subtractProduct = new SubtractProduct($mediator);
        $updatePrice = new UpdatePriceService(
            $discount,
            $mediator
        );
        $deleteAllProduct = new DeleteAllProduct($mediator);
        $deleteAllList = new DeleteAllList($mediator);
        //Agregar colegas al mediador.
        $mediator->addColleague($subtractProduct);
        $mediator->addColleague($updatePrice);
        $mediator->addColleague($deleteAllProduct);
        $mediator->addColleague($deleteAllList);
        //Proxy
        $subtractProxy = new IntermediaryControllerService($subtractProduct);

        session_start();
        $subtractProxy->__invoke($subtractDto);

        return response()->json( $_SESSION[$request->sessionName] );
    }

    public function deleteAllProduct(Request $request)
    {
        $deleteAllDto = new DeleteAllProductDto(
            $request->uuid_product,
            $request->sessionName
        );

        $mediator = new Mediator();
        //Instancia colegas
        $deleteAllProduct = new DeleteAllProduct($mediator);
        $deleteAllList = new DeleteAllList($mediator);
        //Agregar colegas al mediador.
        $mediator->addColleague($deleteAllProduct);
        $mediator->addColleague($deleteAllList);
        //Proxy
        $proxy = new IntermediaryControllerService($deleteAllProduct);

        session_start();
        $proxy->__invoke($deleteAllDto);

        return response()->json( $_SESSION[$request->sessionName] );
    }

    public function deleteAllList(Request $request)
    {
        $deleteAllListDto = new DeleteAllListDto(
            $request->sessionName
        );

        $mediator = new Mediator();
        $deleteAllList = new DeleteAllList($mediator);

        $proxy = new IntermediaryControllerService($deleteAllList);

        session_start();
        $proxy->__invoke($deleteAllListDto);

        return response()->json('successfully removed');
    }
}