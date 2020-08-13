<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConektaCustomer extends Model
{
    protected $table = 'customer_conekta';

    protected $fillable = [
        'idusuario', 'conekta_customer',
    ];
}
