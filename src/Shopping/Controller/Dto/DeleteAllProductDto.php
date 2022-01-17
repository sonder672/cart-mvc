<?php

namespace Src\Shopping\Controller\Dto;

final class DeleteAllProductDto
{
    private $uuid_product;
    private $sessionName;

    public function __construct(string $uuid_product, string $sessionName)
    {
        $this->uuid_product = $uuid_product;
        $this->sessionName = $sessionName;
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