<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    protected $primaryKey = 'id';
    protected $table ='cart';
    public $timestamps = false;

}
