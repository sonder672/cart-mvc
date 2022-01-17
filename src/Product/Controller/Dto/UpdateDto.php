<?php

namespace Src\Product\Controller\Dto;

final class UpdateDto
{
    private $uuid;
    private $stock;
    private $price;
    private $uuidSubCategory;
    private $name;

    public function __construct(
        int $stock,
        int $price,
        string $uuidSubCategory,
        string $name,
        string $uuid
    )
    {
        $this->stock = $stock;
        $this->price = $price;
        $this->uuidSubCategory = $uuidSubCategory;
        $this->name = $name;
        $this->uuid = $uuid;
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

    public function uuid()
    {
        return $this->uuid;
    }
}