<?php

namespace Src\View\Controller;

use App\SubCategory;
use Illuminate\Http\Request;
use Src\Controller\Entity\SubCategory\Dto\CreateDto;
use Src\Controller\Entity\SubCategory\Dto\DeleteDto;
use Src\Controller\Entity\SubCategory\Dto\UpdateDto;
use Src\Controller\Entity\SubCategory\Service\CreateService;
use Src\Controller\Entity\SubCategory\Service\DeleteService;
use Src\Controller\Entity\SubCategory\Service\SelectAllService;
use Src\Controller\Entity\SubCategory\Service\UpdateService;
use Src\Controller\ProxyPattern\IntermediaryControllerService;
use Src\Model\Repository\General\Eloquent\SelectAllRepository;
use Src\Model\Repository\SubCategory\Eloquent\CreateRepository;
use Src\Model\Repository\SubCategory\Eloquent\DeleteRepository;
use Src\Model\Repository\SubCategory\Eloquent\UpdateRepository;

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
