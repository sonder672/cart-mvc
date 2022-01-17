<?php

namespace Src\Shopping\Controller\Service\Delete;

use Src\Patterns\MediatorPattern\AbstractColleague;
use Src\Patterns\ProxyPattern\IIntermediaryControllerService;

class DeleteAllProduct extends AbstractColleague
implements IIntermediaryControllerService
{
    public function execute($event, string $message): void
    {
        echo 'console.log('. json_encode($message, JSON_HEX_TAG) .')';
        if ($message == 'NeedRemoveProduct')
        {
            $this->__invoke($event);
        }
    }

    public function __invoke(object $dto)
    {
        foreach ($_SESSION[$dto->sessionName()] as $i=>$product) 
        {
            if ($product['uuid_product'] == $dto->uuid_product()) 
            {
                unset($_SESSION[$dto->sessionName()]
                [$this->deleteElement($dto->sessionName(), $i)]); 
                break;
            }
        }

        if (empty($_SESSION[$dto->sessionName()])) 
        {
            $this->mediator->send($dto, 'NeedDeleteAll', $this);
        } 
    }

    private function deleteElement($sessionName, $i) 
    {
        if ($i != (count($_SESSION[$sessionName]) - 1)) 
        {                                                      
            $_SESSION[$sessionName] = $this->changeArrayPosition($sessionName, $i);
            return (count($_SESSION[$sessionName]) - 1);
        }
        return $i;                     
    } 

    private function changeArrayPosition ($sessionName, $i) 
    {                                                    
        $arraySpliceOne = array_splice($_SESSION[$sessionName], $i, 1); 

        $arraySpliceTwo = array_splice(
            $_SESSION[$sessionName], 
            0, 
            count($_SESSION[$sessionName])); 
        //el método array_merge hace un intercambio. Buscar documentación.
        return array_merge(
            $arraySpliceTwo, 
            $arraySpliceOne, 
            $_SESSION[$sessionName]
        );          
    }
}