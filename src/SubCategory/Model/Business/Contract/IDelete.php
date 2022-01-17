<?php

namespace Src\SubCategory\Model\Business\Contract;

interface IDelete
{
    public function delete($uuid): void;
}