<?php

namespace Src\View\Controller;

use App\Discount;
use Illuminate\Http\Request;
use Src\Controller\Entity\Discount\Dto\CreateDto;
use Src\Controller\Entity\Discount\Dto\UpdateDto;
use Src\Controller\Entity\Discount\Service\CreateService;
use Src\Controller\Entity\Discount\Service\SelectAllService;
use Src\Controller\Entity\Discount\Service\UpdateService;
use Src\Controller\ProxyPattern\IntermediaryControllerService;
use Src\Model\Repository\Discount\Eloquent\CreateRepository;
use Src\Model\Repository\Discount\Eloquent\UpdateRepository;
use Src\Model\Repository\General\Eloquent\SelectAllRepository;

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