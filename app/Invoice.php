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

    public function carts()
    {
        return $this->hasMany(
            'App\Eloquent\Models\Cart', 
            'uuid_invoice', 
            'uuid');
    }
}
