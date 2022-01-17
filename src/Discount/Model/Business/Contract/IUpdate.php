<?php

namespace Src\Discount\Model\Business\Contract;

use Src\Discount\Model\Business\DiscountEntity;

interface IUpdate
{
    public function update($uuid, DiscountEntity $discount): void;
}