<?php

namespace Src\Controller\Entity\SubCategory\Dto;

final class UpdateDto
{
    private $uuid;
    private $name;
    private $description;
    private $uuid_discount;

    public function __construct(string $name, string $description, string $uuid, $uuid_discount)
    {
        $this->name = $name;
        $this->description = $description;
        $this->uuid = $uuid;
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

    public function uuid()
    {
        return $this->uuid;
    }

    public function uuid_discount()
    {
        return $this->uuid_discount;
    }
}