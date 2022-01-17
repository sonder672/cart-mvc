<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingList extends Model
{
    use HasFactory;

    protected $primaryKey = 'uuid';

    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'uuid',
        'price',
        'quantity',
        'uuid_product',
        'uuid_invoice'
    ];

    public function product()
    {
        return $this->belongsTo(
            'App\Eloquent\Product', 
            'uuid_product', 
            'uuid');
    }

    public function invoice()
    {
        return $this->belongsTo(
            'App\Eloquent\Invoice', 
            'uuid_invoice', 
            'uuid');
    }
}
