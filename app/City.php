<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $primaryKey = 'city_id';
    protected $table ='city';
    public $timestamps = false;


    protected $fillable = [
        'city_name', 'status',
    ];
}
