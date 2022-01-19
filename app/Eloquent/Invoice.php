<?php

namespace App\Eloquent;

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
        'uuid',
        'uuid_customer'
    ];

    public function shoppingLists()
    {
        return $this->hasMany(
            'App\Eloquent\ShoppingList', 
            'uuid_invoice', 
            'uuid');
    }

    public function customer()
    {
        return $this->belongsTo(
            'App\Eloquent\Customer',
            'uuid_customer',
            'uuid'
        );
    }
}
