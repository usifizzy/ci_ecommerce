<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class OrderEx extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];
    protected $attributes = [
        'id' => null,
        'customer_id' => null,
        'customer_name' => null,
        'customer_email' => null,
        'order_no' => null, 
        'amount' => null, 
        'status' => null
    ];
}
