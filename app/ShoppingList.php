<?php

namespace App;

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
            'App\Eloquent\Models\Product', 
            'uuid_product', 
            'uuid');
    }

    public function invoice()
    {
        return $this->belongsTo(
            'App\Eloquent\Models\Invoice', 
            'uuid_invoice', 
            'uuid');
    }
}
