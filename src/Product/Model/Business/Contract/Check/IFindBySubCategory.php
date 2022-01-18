<?php

namespace Src\Product\Model\Business\Contract\Check;

interface IFindBySubCategory
{
    public function findBySubCategory($uuidSubCategory);
}