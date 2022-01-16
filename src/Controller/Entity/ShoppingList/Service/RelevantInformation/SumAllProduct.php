<?php

namespace Src\Controller\Entity\ShoppingList\Service\RelevantInformation;

use Src\Controller\Entity\ShoppingList\Contract\ISumAllProduct;

final class SumAllProduct implements ISumAllproduct
{
    public function __invoke($sessionName): int
    {
        $newPrice = 0;
        foreach($_SESSION[$sessionName] as $i=>$value)
        {
            $newPrice += $value['price'];
        }

        return $newPrice;
    }
}