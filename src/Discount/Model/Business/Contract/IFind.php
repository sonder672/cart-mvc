<?php

namespace Src\Discount\Model\Business\Contract;

interface IFind
{
    public function findOrFail($uuid);
}