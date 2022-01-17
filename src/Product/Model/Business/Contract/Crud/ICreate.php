<?php

namespace Src\Product\Model\Business\Contract\Crud;

use Src\Product\Model\Business\ProductEntity;

interface ICreate
{
    public function create(ProductEntity $product): void;
}