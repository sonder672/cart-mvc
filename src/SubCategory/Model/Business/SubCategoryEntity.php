<?php

namespace Src\SubCategory\Model\Business;

use Src\Patterns\GenerateUuid;
use Src\SubCategory\Model\Business\ValueObject\DescriptionValueObject;
use Src\SubCategory\Model\Business\ValueObject\NameValueObject;

final class SubCategoryEntity
{
    private $uuid;
    private $name;
    private $description;
    private $uuid_discount;

    public function __construct(
        NameValueObject $name, 
        DescriptionValueObject $description, 
        $uuid_discount
        )
    {
        $this->name = $name;
        $this->description = $description;
        $this->uuid_discount = $uuid_discount;
        $this->uuid = (new GenerateUuid())->uuidv4();
    }

    public function name()
    {
        return $this->name->name();
    }

    public function description()
    {
        return $this->description->description();
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