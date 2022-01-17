<?php

namespace Src\Product\Model\Business\Contract\Check;

interface ICheckStock
{
    public function stock($uuid);
}