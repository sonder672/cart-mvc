<?php

namespace Src\Shopping\Controller\Dto;

final class ShowDto
{
    private $sessionName;

    public function __construct(string $sessionName)
    {
        $this->sessionName = $sessionName;
    }

    public function sessionName()
    {
        return $this->sessionName;
    }
}