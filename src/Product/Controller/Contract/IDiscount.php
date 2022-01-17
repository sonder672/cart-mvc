<?php

namespace Src\Product\Controller\Contract;

interface IDiscount
{
    public function productWithDiscount($uuid_product);
}