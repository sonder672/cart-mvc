<?php

namespace Src\Model\Entity\Product\Contract;

interface ICheckStock
{
    public function stock($uuid);
}