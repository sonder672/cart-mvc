<?php

namespace Src\Product\Model\Business\Contract\Crud;

use Src\Product\Model\Business\ProductEntity;

interface IUpdate
{
    public function update($uuid, ProductEntity $product): void;
}