<?php

namespace Src\Product\Model\Business\Contract\Crud;

interface IUpdateSoldOut
{
    public function updateSoldOut($uuid): void;
}