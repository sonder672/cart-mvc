<?php

namespace Src\Product\Model\Business\Contract\Check;

interface IFindBySubCategory
{
    public function findBySubCategory($uuid_sub_category);
}