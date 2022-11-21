<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    protected $fillable = [
        'id','description','name'
    ];
    protected $table = 'cate';
}
