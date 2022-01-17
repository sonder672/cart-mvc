<?php

namespace Src\Discount\Model\Business\Contract;

use Src\Discount\Model\Business\DiscountEntity;

interface ICreate
{
    public function create(DiscountEntity $discount): void;
}