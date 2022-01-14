<?php

namespace Src\Model\Entity\Product\Contract;

interface IDelete
{
    public function delete($uuid): void;
}