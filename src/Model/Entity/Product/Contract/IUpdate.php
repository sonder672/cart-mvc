<?php

namespace Src\Model\Entity\Product\Contract;

use Src\Model\Entity\Product\ProductEntity;

interface IUpdate
{
    public function update($uuid, ProductEntity $product): void;
}