<?php

namespace Src\Controller\Entity\Product\Contract;

interface IDiscount
{
    public function productWithDiscount($uuid_product);
}