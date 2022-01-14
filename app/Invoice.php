<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $primaryKey = 'uuid';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'price',
        'uuid'
    ];

    public function shoppingLists()
    {
        return $this->hasMany(
            'App\ShoppingList', 
            'uuid_invoice', 
            'uuid');
    }
}
