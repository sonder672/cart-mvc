<?php

namespace Src\Shopping\Model\Business\Contract;

use Src\Shopping\Model\Business\ShoppingListEntity;

interface ICreate
{
    public function create(ShoppingListEntity $shoppingList): void;
}