<?php

namespace Src\Model\Repository\SubCategory\Eloquent;

use Src\Model\Entity\SubCategory\Contract\ICreate;
use Src\Model\Entity\SubCategory\SubCategoryEntity;

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