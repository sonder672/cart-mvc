<?php

namespace Src\Model\Entity\SubCategory\Contract;

use Src\Model\Entity\SubCategory\SubCategoryEntity;

interface ICreate
{
    public function create(SubCategoryEntity $subCategory): void;
}