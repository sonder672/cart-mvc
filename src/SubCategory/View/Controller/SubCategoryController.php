<?php

namespace Src\SubCategory\View\Controller;

use App\Controller;
use App\Eloquent\SubCategory;
use Illuminate\Http\Request;
use Src\Patterns\ProxyPattern\IntermediaryControllerService;
use Src\SubCategory\Controller\Dto\CreateDto;
use Src\SubCategory\Controller\Dto\DeleteDto;
use Src\SubCategory\Controller\Dto\UpdateDto;
use Src\SubCategory\Controller\Service\CreateService;
use Src\SubCategory\Controller\Service\DeleteService;
use Src\SubCategory\Controller\Service\SelectAllService;
use Src\SubCategory\Controller\Service\UpdateService;
use Src\SubCategory\Model\Repository\Eloquent\CreateRepository;
use Src\SubCategory\Model\Repository\Eloquent\DeleteRepository;
use Src\SubCategory\Model\Repository\Eloquent\SelectAllRepository;
use Src\SubCategory\Model\Repository\Eloquent\UpdateRepository;

class SubCategoryController extends Controller
{
    public function create(Request $request)
    {
        $dto = new CreateDto(
            $request->name,
            $request->description,
            $request->uuid_discount
        );

        $createRepository = new CreateRepository(new SubCategory());
        $createProxy = new IntermediaryControllerService(
            new CreateService($createRepository),
        );

        $createProxy->__invoke($dto); 

        return response()->json(['result' => 'Created']);
    }

    public function destroy($uuid)
    {
        $dto = new DeleteDto($uuid);

        $deleteRepository = new DeleteRepository(new SubCategory());
        $deleteProxy = new IntermediaryControllerService(
            new DeleteService($deleteRepository)
        );

        $deleteProxy->__invoke($dto);

        return response()->json(['result' => 'Deleted']);
    }

    public function update($uuid, Request $request)
    {
        $dto = new UpdateDto(
            $request->name,
            $request->description,
            $uuid,
            $request->uuid_discount
        );

        $updateRepository = new UpdateRepository(new SubCategory());
        $updateProxy = new IntermediaryControllerService(
            new UpdateService($updateRepository)
        );

        $updateProxy->__invoke($dto);

        return response()->json(['result' => 'Updated']);
    }

    public function index()
    {
        $indexRepository = new SelectAllRepository(new SubCategory());
        $all = new SelectAllService($indexRepository);
        $all->__invoke();

        return response()->json($all->__invoke());
    }
}
