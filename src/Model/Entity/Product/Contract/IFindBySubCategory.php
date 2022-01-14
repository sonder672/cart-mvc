<?php

namespace Src\Model\Entity\Product\Contract;

interface IFindBySubCategory
{
    public function findBySubCategory($uuid_sub_category);
}