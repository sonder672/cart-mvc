<?php

namespace Src\Product\Model\Business\Contract\Crud;

interface IFind
{
    public function findOrFail($uuid);
}