<?php

namespace Src\Product\Controller\Service\Check;

use Src\Product\Controller\Contract\IDiscount;
use Src\Product\Model\Business\Contract\Crud\IFind;
use Src\SubCategory\Model\Business\Contract\IFindByDiscount;

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