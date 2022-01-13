<?php

namespace Src\Model\Entity\Discount\Contract;

use Src\Model\Entity\Discount\DiscountEntity;

interface IUpdate
{
    public function update($uuid, DiscountEntity $discount): void;
}