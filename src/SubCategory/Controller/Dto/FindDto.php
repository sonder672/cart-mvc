<?php

namespace Src\SubCategory\Controller\Dto;

final class FindDto
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