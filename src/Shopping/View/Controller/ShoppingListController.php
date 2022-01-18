<?php

namespace Src\Shopping\View\Controller;

use App\Controller;
use App\Eloquent\Invoice;
use Src\Patterns\ProxyPattern\IntermediaryControllerService;
use Src\Shopping\Controller\Dto\SelectByInvoiceDto;
use Src\Shopping\Controller\Service\SelectAllService;
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
}