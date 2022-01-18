<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $primaryKey = 'uuid';

    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'email',
        'password',
        'uuid'
    ];

    public function invoices()
    {
        return $this->hasMany(
            'App\Eloquent\Invoice', 
            'uuid_customer', 
            'uuid');
    }
}
