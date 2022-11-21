<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $fillable = [
        'id','user_order','user_name','phone','address','amount','payment','note','status','product_id'
    ];
    protected $table = 'orders';
}
