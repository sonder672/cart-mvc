<?php

namespace Src\Model\Entity\Product;

use Src\Controller\GenerateUuid;
use Src\Model\Entity\Product\ValueObject\PriceValueObject;
use Src\Model\Entity\Product\ValueObject\StockValueObject;

final class ProductEntity
{
    private $stock;
    private $uuid;
    private $price;
    private $uuidSubCategory;
    private $name;

    public function __construct(
        StockValueObject $stock,
        PriceValueObject $price,
        string $uuidSubCategory,
        string $name
    )
    {
        $this->stock = $stock;
        $this->price = $price;
        $this->uuidSubCategory = $uuidSubCategory;
        $this->name = $name;
        $this->uuid = (new GenerateUuid())->uuidv4();
    }

    public function stock()
    {
        return $this->stock->stock();
    }

    public function price()
    {
        return $this->price->price();
    }

    public function uuidSubCategory()
    {
        return $this->uuidSubCategory;
    }

    public function name()
    {
        return $this->name;
    }

    public function uuid()
    {
        return $this->uuid;
    }
}