<?php

namespace Src\Product\Model\Business\Contract\Crud;

interface IDelete
{
    public function delete($uuid): void;
}