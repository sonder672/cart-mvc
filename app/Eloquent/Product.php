<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'uuid';

    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'price',
        'uuid',
        'uuid_sub_category',
        'sold_out',
        'stock'
    ];

    public function subCategory()
    {
        return $this->belongsTo(
            'App\Eloquent\SubCategory', 
            'uuid_sub_category', 
            'uuid');
    }

    public function shoppingLists()
    {
        return $this->hasMany(
            'App\Eloquent\ShoppingList', 
            'uuid_product', 
            'uuid');
    }
}
