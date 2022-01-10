<?php

namespace Src\Controller\Entity\SubCategory\Dto;

final class DeleteDto
{
    private $uuid;

    public function __construct(string $uuid)
    {
        $this->uuid = $uuid;
    }

    public function uuid()
    {
        return $this->uuid;
    }
}