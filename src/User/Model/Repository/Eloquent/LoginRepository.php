<?php

namespace Src\User\Model\Repository\Eloquent;

use Src\User\Model\Business\Contract\ILogin;

final class LoginRepository implements ILogin
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function login($email)
    {
        return $this->model->where('email', $email)
                    ->select('uuid', 'password')
                    ->get();
    }
}