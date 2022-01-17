<?php

namespace Src\SubCategory\Controller\Dto;

final class CreateDto
{
    private $name;
    private $description;
    private $uuid_discount;

    public function __construct(string $name, string $description, $uuid_discount)
    {
        $this->name = $name;
        $this->description = $description;
        $this->uuid_discount = $uuid_discount;
    }

    public function name()
    {
        return $this->name;
    }

    public function description()
    {
        return $this->description;
    }

    public function uuid_discount()
    {
        return $this->uuid_discount;
    }
}