<?php

namespace Src\SubCategory\Model\Business\Contract;

interface IFind
{
    public function findOrFail($uuid);
}