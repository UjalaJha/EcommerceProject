<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CityTest extends Model
{
    protected $primaryKey = 'city_id';
    protected $table ='city';
    public $timestamps = false;

     protected $fillable = [
        'city_name', 'status',
    ];

}
