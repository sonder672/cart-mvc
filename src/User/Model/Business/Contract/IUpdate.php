<?php

namespace Src\User\Model\Business\Contract;

use Src\User\Model\Business\UserEntity;

interface IUpdate
{
    public function update($uuid, UserEntity $user): void;
}