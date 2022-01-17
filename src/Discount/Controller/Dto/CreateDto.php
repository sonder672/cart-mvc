<?php

namespace Src\Discount\Controller\Dto;

final class CreateDto
{
    private $description;
    private $endDate;
    private $percent;

    public function __construct(string $description, $endDate, int $percent)
    {
        $this->description = $description;
        $this->endDate = $endDate;
        $this->percent = $percent;
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