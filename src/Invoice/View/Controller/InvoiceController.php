<?php

namespace Src\Invoice\View\Controller;

use App\Controller;
use App\Eloquent\Customer;
use App\Eloquent\Invoice;
use Src\Invoice\Controller\Service\SelectAllService;
use Src\Invoice\Model\Repository\Eloquent\SelectAllRepository;

class InvoiceController extends Controller
{
    public function index()
    {
        $indexRepository = new SelectAllRepository(new Customer());
        $all = new SelectAllService($indexRepository);
        $all->__invoke();

        return response()->json($all->__invoke());
    }
}