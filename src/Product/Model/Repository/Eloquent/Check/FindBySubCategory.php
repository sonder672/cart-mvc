<?php

namespace Src\Product\Model\Repository\Eloquent\Check;

use Src\Product\Model\Business\Contract\Check\IFindBySubCategory;

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