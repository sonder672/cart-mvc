<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $primaryKey = 'uuid';

    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'description',
        'uuid',
        'uuid_discount'
    ];

    public function discount()
    {
        return $this->belongsTo(
            'App\Discount', 
            'uuid_discount', 
            'uuid');
    }

    public function products()
    {
        return $this->hasMany(
            'App\Product', 
            'uuid_sub_category', 
            'uuid');
    }
}
