<?php

namespace Src\Controller\Entity\ShoppingList\Dto;

final class GeneralDto
{
    private $quantity;
    private $uuid_product;
    private $sessionName;

    public function __construct(int $quantity, string $uuid_product, string $sessionName)
    {
        $this->quantity = $quantity;
        $this->uuid_product = $uuid_product;
        $this->sessionName = $sessionName;
    }

    public function quantity()
    {
        return $this->quantity;
    }

    public function uuid_product()
    {
        return $this->uuid_product;
    }

    public function sessionName()
    {
        return $this->sessionName;
    }
}