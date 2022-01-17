<?php

namespace Src\SubCategory\Model\Business\Contract;

use Src\SubCategory\Model\Business\SubCategoryEntity;

interface ICreate
{
    public function create(SubCategoryEntity $subCategory): void;
}