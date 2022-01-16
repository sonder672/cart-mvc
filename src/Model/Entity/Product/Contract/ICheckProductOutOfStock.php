<?php

namespace Src\Model\Entity\Product\Contract;

interface ICheckProductOutOfStock
{
    public function soldOut($uuid);
}