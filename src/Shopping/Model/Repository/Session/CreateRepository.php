<?php

namespace Src\Shopping\Model\Repository\Session;

use Src\Shopping\Model\Business\Contract\ICreate;
use Src\Shopping\Model\Business\ShoppingListEntity;

final class CreateRepository implements ICreate
{
    private $session;

    public function __construct(string $session)
    {
        $this->session = $session;
    }

    public function create(ShoppingListEntity $cart): void
    {
        $numProducts = 0;

        if (isset($_SESSION[$this->session]))
        {
            $numProducts = count( $_SESSION[$this->session] ); 
        }
        
        $_SESSION[$this->session][$numProducts] = [
            'price' => $cart->price(),
            'quantity' => $cart->quantity(),
            'uuid_product' => $cart->uuid_product(),
            'uuid' => $cart->uuid()
        ];
    }
}