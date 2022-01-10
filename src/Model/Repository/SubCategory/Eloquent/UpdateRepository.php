<?php

namespace Src\Model\Repository\SubCategory\Eloquent;

use Src\Model\Entity\SubCategory\Contract\IUpdate;
use Src\Model\Entity\SubCategory\SubCategoryEntity;

final class UpdateRepository implements IUpdate
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function update($uuid, SubCategoryEntity $subCategory): void
    {
        $this->model
             ->findOrFail($uuid)
             ->update([
                'description' => $subCategory->description(),
                'name' => $subCategory->name(),
                'uuid_discount' => $subCategory->uuid_discount()
            ]);
    }
}