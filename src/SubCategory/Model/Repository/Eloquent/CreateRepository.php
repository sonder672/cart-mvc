<?php

namespace Src\SubCategory\Model\Repository\Eloquent;

use Src\SubCategory\Model\Business\Contract\ICreate;
use Src\SubCategory\Model\Business\SubCategoryEntity;

final class CreateRepository implements ICreate
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function create(SubCategoryEntity $subCategory): void
    {
        $this->model->create([
            'description' => $subCategory->description(),
            'name' => $subCategory->name(),
            'uuid' => $subCategory->uuid(),
            'uuid_discount' => $subCategory->uuid_discount()
        ]);
    }
}