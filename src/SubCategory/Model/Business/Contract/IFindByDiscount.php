<?php

namespace Src\SubCategory\Model\Business\Contract;

interface IFindByDiscount
{
    public function findByDiscount($uuid_sub_category);
}