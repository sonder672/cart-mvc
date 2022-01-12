<?php

namespace Src\Model\Entity\Product\Contract;

interface IFind
{
    public function findOrFail($uuid);
}