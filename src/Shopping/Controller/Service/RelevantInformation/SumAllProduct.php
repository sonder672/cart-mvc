<?php

namespace Src\Shopping\Controller\Service\RelevantInformation;

use Src\Shopping\Controller\Contract\ISumAllProduct;

final class SumAllProduct implements ISumAllProduct
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