<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable = [
        'id','description','name','images','cate','price'
    ];
    protected $table = 'products';
}
