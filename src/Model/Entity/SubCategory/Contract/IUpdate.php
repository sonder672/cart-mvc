<?php

namespace Src\Model\Entity\SubCategory\Contract;

use Src\Model\Entity\SubCategory\SubCategoryEntity;

interface IUpdate
{
    public function update($uuid, SubCategoryEntity $subCategory): void;
}