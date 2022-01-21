<?php

namespace Src\Shopping\View\Controller;

use App\Controller;
use App\Eloquent\Invoice;
use Illuminate\Http\Request;
use Src\Patterns\ProxyPattern\IntermediaryControllerService;
use Src\Shopping\Controller\Dto\SelectByInvoiceDto;
use Src\Shopping\Controller\Dto\ShowDto;
use Src\Shopping\Controller\Service\SelectAllService;
use Src\Shopping\Controller\Service\ShowService;
use Src\Shopping\Model\Repository\Eloquent\SelectByInvoiceRepository;

class ShoppingListController extends Controller
{
    public function index($uuidInvoice)
    {
        $dto = new SelectByInvoiceDto($uuidInvoice);

        $repository = new SelectByInvoiceRepository(new Invoice());
        $selectProxy = new IntermediaryControllerService(
            new SelectAllService(
                $repository
            )
        );

        $selectProxy->__invoke($dto);

        return response()->json($selectProxy->__invoke($dto));
    }

    public function show($uuidSubCategory)
    {
        $dto = new ShowDto($uuidSubCategory);

        $proxy = new IntermediaryControllerService(
            new ShowService()
        );

        $proxy->__invoke($dto);

        return response()->json($proxy->__invoke($dto));
    }
}