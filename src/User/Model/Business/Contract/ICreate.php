<?php

namespace Src\User\Model\Business\Contract;

use Src\User\Model\Business\UserEntity;

interface ICreate
{
    public function create(UserEntity $user): void;
}
