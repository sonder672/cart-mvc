<?php

namespace Src\Discount\View\Controller;

use App\Controller;
use App\Eloquent\Discount;
use Illuminate\Http\Request;
use Src\Discount\Controller\Dto\CreateDto;
use Src\Discount\Controller\Dto\UpdateDto;
use Src\Discount\Controller\Service\CreateService;
use Src\Discount\Controller\Service\SelectAllService;
use Src\Discount\Controller\Service\UpdateService;
use Src\Discount\Model\Repository\Eloquent\CreateRepository;
use Src\Discount\Model\Repository\Eloquent\UpdateRepository;
use Src\Model\Repository\General\Eloquent\SelectAllRepository;
use Src\Patterns\ProxyPattern\IntermediaryControllerService;

class DiscountController extends Controller
{
    public function create(Request $request)
    {
        $createDto = new CreateDto(
            $request->description,
            $request->endDate,
            $request->percent
        );

        $repository = new CreateRepository(new Discount());
        $proxy = new IntermediaryControllerService(
            new CreateService($repository)
        );

        $proxy->__invoke($createDto);

        return response()->json(['result' => 'Created']);
    }

    public function update($uuid, Request $request)
    {
        $dto = new UpdateDto(
            $uuid,
            $request->description,
            $request->endDate,
            $request->percent
        );

        $updateRepository = new UpdateRepository(new Discount());
        $updateProxy = new IntermediaryControllerService(
            new UpdateService($updateRepository)
        );

        $updateProxy->__invoke($dto);

        return response()->json(['result' => 'Updated']);
    }

    public function show()
    {
        $indexRepository = new SelectAllRepository(new Discount());
        $all = new SelectAllService($indexRepository);
        $all->__invoke();

        return response()->json($all->__invoke());
    }
}