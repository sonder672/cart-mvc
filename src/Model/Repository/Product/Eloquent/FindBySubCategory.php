<?php

namespace Src\Model\Repository\Product\Eloquent;

use Src\Model\Entity\Product\Contract\IFindBySubCategory;

final class FindBySubCategory implements IFindBySubCategory
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function findBySubCategory($uuid_sub_category)
    {
        return $this->model->findOrFail($uuid_sub_category)
                    ->products;
    }
}