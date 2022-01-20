<?php

namespace Src\Product\View\Controller;

use App\Controller;
use App\Eloquent\Product;
use App\Eloquent\SubCategory;
use Illuminate\Http\Request;
use Src\Patterns\ProxyPattern\IntermediaryControllerService;
use Src\Product\Controller\Dto\CreateDto;
use Src\Product\Controller\Dto\DeleteDto;
use Src\Product\Controller\Dto\FindDto;
use Src\Product\Controller\Dto\UpdateDto;
use Src\Product\Controller\Service\Check\ShowBySubCategory;
use Src\Product\Controller\Service\Crud\CreateService;
use Src\Product\Controller\Service\Crud\DeleteService;
use Src\Product\Controller\Service\Crud\FindService;
use Src\Product\Controller\Service\Crud\UpdateService;
use Src\Product\Model\Repository\Eloquent\Check\FindBySubCategory;
use Src\Product\Model\Repository\Eloquent\Crud\CreateRepository;
use Src\Product\Model\Repository\Eloquent\Crud\DeleteRepository;
use Src\Product\Model\Repository\Eloquent\Crud\FindRepository;
use Src\Product\Model\Repository\Eloquent\Crud\UpdateRepository;

class ProductController extends Controller
{
    public function create(Request $request)
    {
        $dto = new CreateDto(
            $request->stock,
            $request->price,
            $request->uuidSubCategory,
            $request->name
        );

        $createRepository = new CreateRepository(new Product());
        $createProxy = new IntermediaryControllerService(
            new CreateService($createRepository),
        );

        $createProxy->__invoke($dto); 

        return response()->json(['result' => 'Created']);
    }

    public function destroy($uuid)
    {
        $dto = new DeleteDto($uuid);

        $deleteRepository = new DeleteRepository(new Product());
        $deleteProxy = new IntermediaryControllerService(
            new DeleteService($deleteRepository)
        );

        $deleteProxy->__invoke($dto);

        return response()->json(['result' => 'Deleted']);
    }

    public function update($uuid, Request $request)
    {
        $dto = new UpdateDto(
            $request->stock,
            $request->price,
            $request->uuidSubCategory,
            $request->name,
            $uuid
        );

        $updateRepository = new UpdateRepository(new Product());
        $updateProxy = new IntermediaryControllerService(
            new UpdateService($updateRepository)
        );

        $updateProxy->__invoke($dto);

        return response()->json(['result' => 'Updated']);
    }

    public function indexBySubCategory($uuidSubCategory)
    {
        $indexRepository = new FindBySubCategory(new SubCategory());
        $allProductSubCategory = new ShowBySubCategory($indexRepository);
        
        $allProductSubCategory->productSubCategory($uuidSubCategory);

        return response()->json(
            $allProductSubCategory->productSubCategory($uuidSubCategory)
        );
    }

    public function find($uuid)
    {
        $dto = new FindDto($uuid);

        $repository = new FindRepository(new Product());
        $proxy = new IntermediaryControllerService(
            new FindService($repository)
        );

        $proxy->__invoke($dto);

        return response()->json($proxy->__invoke($dto));
    }
}