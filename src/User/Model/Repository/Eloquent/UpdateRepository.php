<?php

namespace Src\User\Model\Repository\Eloquent;

use Src\User\Model\Business\Contract\IUpdate;
use Src\User\Model\Business\UserEntity;

final class UpdateRepository implements IUpdate
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function update($uuid, UserEntity $user): void
    {
        $this->model->findOrFail($uuid)
                ->update([
                'email' => $user->email(),
                'name' => $user->name(),
                'password' => $user->password(),
                ]);
    }
}