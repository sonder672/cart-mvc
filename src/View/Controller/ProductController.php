<?php

namespace Src\View\Controller;

use App\Product;
use App\SubCategory;
use Illuminate\Http\Request;
use Src\Controller\Entity\Product\Dto\CreateDto;
use Src\Controller\Entity\Product\Dto\DeleteDto;
use Src\Controller\Entity\Product\Dto\ProductSubCategoryDto;
use Src\Controller\Entity\Product\Dto\UpdateDto;
use Src\Controller\Entity\Product\Service\CreateService;
use Src\Controller\Entity\Product\Service\DeleteService;
use Src\Controller\Entity\Product\Service\ShowBySubCategory;
use Src\Controller\Entity\Product\Service\UpdateService;
use Src\Controller\ProxyPattern\IntermediaryControllerService;
use Src\Model\Repository\Product\Eloquent\CreateRepository;
use Src\Model\Repository\Product\Eloquent\DeleteRepository;
use Src\Model\Repository\Product\Eloquent\FindBySubCategory;
use Src\Model\Repository\Product\Eloquent\UpdateRepository;

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

    public function indexBySubCategory(Request $request)
    {
        $dto = new ProductSubCategoryDto(
            $request->uuidSubCategory
        );

        $indexRepository = new FindBySubCategory(new SubCategory());
        $allProxy = new IntermediaryControllerService(
            new ShowBySubCategory($indexRepository)
        );

        $allProxy->__invoke($dto);
        
        return response()->json($allProxy->__invoke($dto));
    }
}