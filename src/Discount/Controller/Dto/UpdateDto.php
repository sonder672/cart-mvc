<?php

namespace Src\Discount\Controller\Dto;

final class UpdateDto
{
    private $uuid;
    private $description;
    private $endDate;
    private $percent;

    public function __construct($uuid, string $description, $endDate, int $percent)
    {
        $this->uuid = $uuid;
        $this->description = $description;
        $this->endDate = $endDate;
        $this->percent = $percent;
    }

    public function uuid()
    {
        return $this->uuid;
    }

    public function description()
    {
        return $this->description;
    }

    public function endDate()
    {
        return $this->endDate;
    }

    public function percent()
    {
        return $this->percent;
    }
}