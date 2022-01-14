<?php

namespace Src\Controller\Entity\Product\Dto;

final class ProductSubCategoryDto
{
    private $uuidSubCategory;

    public function __construct(string $uuidSubCategory)
    {
        $this->uuidSubCategory = $uuidSubCategory;
    }

    public function uuidSubCategory()
    {
        return $this->uuidSubCategory;
    }
}