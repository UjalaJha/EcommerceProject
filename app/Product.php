<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   	protected $primaryKey = 'product_id';
    protected $table ='tbl_products';
    public $timestamps = false;
    protected $fillable = ['product_id', 'product_name','product_price','quantity','product_description','product_short_description	','meta_title','meta_description','	meta_keywords','status','created_on','created_by','updated_on','updated_by'];
    protected $rules = [
    'product_name' => 'unique:products',
    'product_code' => 'unique:products'
    
	];

}
