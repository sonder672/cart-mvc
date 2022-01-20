<?php

namespace Src\User\View\Controller;

use App\Controller;
use App\Eloquent\Customer;
use Illuminate\Http\Request;
use Src\Patterns\ProxyPattern\IntermediaryControllerService;
use Src\User\Controller\Dto\CreateDto;
use Src\User\Controller\Dto\FindDto;
use Src\User\Controller\Dto\UpdateDto;
use Src\User\Controller\Service\CreateService;
use Src\User\Controller\Service\FindService;
use Src\User\Controller\Service\UpdateService;
use Src\User\Model\Repository\Eloquent\CreateRepository;
use Src\User\Model\Repository\Eloquent\FindOrFailRepository;
use Src\User\Model\Repository\Eloquent\UpdateRepository;

class UserController extends Controller
{
    public function create(Request $request)
    {
        $dto = new CreateDto(
            $request->email,
            $request->name,
            $request->password
        );

        $repository = new CreateRepository(new Customer());
        $createProxy = new IntermediaryControllerService(
            new CreateService($repository)
        );

        $createProxy->__invoke($dto);

        return response()->json('Created');
    }

    public function update(Request $request)
    {
        $dto = new UpdateDto(
            $request->email,
            $request->name,
            $request->password,
            $request->newPassword
        );

        $updateRepository = new UpdateRepository(new Customer());
        $findRepository = new FindOrFailRepository(new Customer());
        $updateProxy = new IntermediaryControllerService(
            new UpdateService($updateRepository, $findRepository)
        );

        $updateProxy->__invoke($dto);

        return response()->json('Updated');
    }

    public function find()
    {

        $dto = new FindDto($_SESSION['uuid']);

        $repository = new FindOrFailRepository(new Customer());
        $proxy = new IntermediaryControllerService(
            new FindService($repository)
        );

        $proxy->__invoke($dto);

        return response()->json($proxy->__invoke($dto));
    }
}