<?php

namespace Src\Product\Model\Business\Contract\Check;

interface ISubtractStock
{
    public function update($uuid, $quantity): void;
}