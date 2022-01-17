<?php

namespace Src\SubCategory\Model\Business\Contract;

use Src\SubCategory\Model\Business\SubCategoryEntity;

interface IUpdate
{
    public function update($uuid, SubCategoryEntity $subCategory): void;
}