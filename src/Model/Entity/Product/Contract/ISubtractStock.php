<?php

namespace Src\Model\Entity\Product\Contract;

interface ISubtractStock
{
    public function update($uuid, $quantity): void;
}