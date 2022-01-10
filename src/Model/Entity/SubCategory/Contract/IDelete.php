<?php

namespace Src\Model\Entity\SubCategory\Contract;

interface IDelete
{
    public function delete($uuid): void;
}