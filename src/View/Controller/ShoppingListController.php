<?php

namespace Src\View\Controller;

use App\Product;
use App\SubCategory;
use Illuminate\Http\Request;
use Src\Controller\Entity\Product\Service\ProductWithDiscount;
use Src\Controller\Entity\ShoppingList\Dto\DeleteAllListDto;
use Src\Controller\Entity\ShoppingList\Dto\DeleteAllProductDto;
use Src\Controller\Entity\ShoppingList\Dto\GeneralDto;
use Src\Controller\Entity\ShoppingList\Service\Add\AddProductService;
use Src\Controller\Entity\ShoppingList\Service\Add\SumProductService;
use Src\Controller\Entity\ShoppingList\Service\Delete\DeleteAllList;
use Src\Controller\Entity\ShoppingList\Service\Delete\DeleteAllProduct;
use Src\Controller\Entity\ShoppingList\Service\Delete\SubtractProduct;
use Src\Controller\Entity\ShoppingList\Service\UpdatePriceService;
use Src\Controller\MediatorPattern\Mediator;
use Src\Controller\ProxyPattern\IntermediaryControllerService;
use Src\Model\Repository\Product\Eloquent\FindRepository;
use Src\Model\Repository\ShoppingList\Session\CreateRepository;
use Src\Model\Repository\SubCategory\Eloquent\FindByDiscount;

class ShoppingListController extends Controller
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
            $discount
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