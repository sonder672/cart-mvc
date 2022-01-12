<?php

namespace Src\Controller\Entity\ShoppingList\Dto;

final class DeleteAllListDto
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