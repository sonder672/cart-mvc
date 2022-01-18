<?php

namespace Src\User\Model\Business\Contract;

interface ILogin
{
    public function login($email);
}