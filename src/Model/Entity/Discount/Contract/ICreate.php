<?php

namespace Src\Model\Entity\Discount\Contract;

use Src\Model\Entity\Discount\DiscountEntity;

interface ICreate
{
    public function create(DiscountEntity $discount): void;
}