<?php

namespace Src\Product\Model\Business;

use Src\Patterns\GenerateUuid;
use Src\Product\Model\Business\ValueObject\PriceValueObject;
use Src\Product\Model\Business\ValueObject\StockValueObject;

final class ProductEntity
{
    private $stock;
    private $uuid;
    private $price;
    private $uuidSubCategory;
    private $name;
    private $soldOut;

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
        $this->soldOut = false;
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

    public function soldOut()
    {
        return $this->soldOut;
    }
}