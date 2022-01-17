<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $primaryKey = 'uuid';

    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'percent',
        'description',
        'uuid',
        'start_date',
        'end_date'
    ];

    public function subCategories()
    {
        return $this->hasMany(
            'App\Eloquent\SubCategory', 
            'uuid_discount', 
            'uuid');
    }
}
