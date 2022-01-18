<?php

namespace Src\User\Model\Repository\Eloquent;

use Src\User\Model\Business\Contract\ICreate;
use Src\User\Model\Business\UserEntity;

final class CreateRepository implements ICreate
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function create(UserEntity $user): void
    {
        $this->model->create([
            'email' => $user->email(),
            'name' => $user->name(),
            'password' => $user->password(),
            'uuid' => $user->uuid()
        ]);
    }
}