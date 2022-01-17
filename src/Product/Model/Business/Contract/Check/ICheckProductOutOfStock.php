<?php

namespace Src\Product\Model\Business\Contract\Check;

interface ICheckProductOutOfStock
{
    public function soldOut($uuid);
}