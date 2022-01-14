<?php

namespace Src\Model\Entity\SubCategory\Contract;

interface IFindByDiscount
{
    public function findByDiscount($uuid_sub_category);
}