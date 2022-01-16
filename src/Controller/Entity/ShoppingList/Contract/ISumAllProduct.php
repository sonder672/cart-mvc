<?php

namespace Src\Controller\Entity\ShoppingList\Contract;

interface ISumAllProduct
{
    public function __invoke($sessionName): int;
}