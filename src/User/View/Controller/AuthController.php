<?php

namespace Src\User\View\Controller;

use App\Controller;
use App\Eloquent\Customer;
use Illuminate\Http\Request;
use Src\Patterns\ProxyPattern\IntermediaryControllerService;
use Src\User\Controller\Dto\LoginDto;
use Src\User\Controller\Service\LoginService;
use Src\User\Model\Repository\Eloquent\LoginRepository;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $dto = new LoginDto(
            $request->email, 
            $request->password
        );

        $repository = new LoginRepository(new Customer());
        $proxy = new IntermediaryControllerService(
            new LoginService($repository)
        );

        session_start();
        $proxy->__invoke($dto);

        return response()->json('Welcome '. $_SESSION['uuid']);
    }

    public function logout()
    {
        session_start();

        unset($_SESSION['uuid']);

        return response()->json('Bye');
    }
}