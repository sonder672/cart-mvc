<?php

namespace Src\Model\Entity\Product\Contract;

interface IUpdateSoldOut
{
    public function updateSoldOut($uuid): void;
}