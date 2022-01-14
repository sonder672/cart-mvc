<?php

namespace Src\Model\Entity\Product\Contract;

use Src\Model\Entity\Product\ProductEntity;

interface ICreate
{
    public function create(ProductEntity $product): void;
}