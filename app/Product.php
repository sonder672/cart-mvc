<?php

namespace App;

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
        'uuid_sub_category'
    ];

    public function subCategory()
    {
        return $this->belongsTo(
            'App\Eloquent\Models\SubCategory', 
            'uuid_sub_category', 
            'uuid');
    }

    public function carts()
    {
        return $this->hasMany(
            'App\Eloquent\Models\Cart', 
            'uuid_product', 
            'uuid');
    }
}
