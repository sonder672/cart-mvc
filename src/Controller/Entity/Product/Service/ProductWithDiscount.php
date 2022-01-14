<?php

namespace Src\Controller\Entity\Product\Service;

use Src\Controller\Entity\Product\Contract\IDiscount;
use Src\Model\Entity\Product\Contract\IFind;
use Src\Model\Entity\SubCategory\Contract\IFindByDiscount;

final class ProductWithDiscount implements IDiscount
{
    private $findProduct;
    private $discount;

    public function __construct(IFind $findProduct, IFindByDiscount $discount)
    {
        $this->findProduct = $findProduct;
        $this->discount = $discount;
    }

    public function productWithDiscount($uuid_product)
    {
        $findProduct = $this->findProduct->findOrFail(
            $uuid_product
        );

        $discount = $this->discount->findByDiscount(
            $findProduct->uuid_sub_category
        );

        $price = $findProduct->price;
        
        if ($discount != null)
        {
            $fullDiscount = ($findProduct->price * $discount) / 100;
            $price = $findProduct->price - $fullDiscount;
        } 
        
        return $price;
    }
}