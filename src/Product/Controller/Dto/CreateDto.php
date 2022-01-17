<?php

namespace Src\Product\Controller\Dto;

final class CreateDto
{
    private $stock;
    private $price;
    private $uuidSubCategory;
    private $name;

    public function __construct(
        int $stock,
        int $price,
        string $uuidSubCategory,
        string $name
    )
    {
        $this->stock = $stock;
        $this->price = $price;
        $this->uuidSubCategory = $uuidSubCategory;
        $this->name = $name;
    }

    public function stock()
    {
        return $this->stock;
    }

    public function price()
    {
        return $this->price;
    }

    public function uuidSubCategory()
    {
        return $this->uuidSubCategory;
    }

    public function name()
    {
        return $this->name;
    }
}