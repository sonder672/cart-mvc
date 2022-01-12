<?php

namespace Src\Model\Entity\ShoppingList\Contract;

use Src\Model\Entity\ShoppingList\ShoppingListEntity;

interface ICreate
{
    public function create(ShoppingListEntity $shoppingList): void;
}