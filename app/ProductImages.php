<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    
    protected $primaryKey = 'product_id';
    protected $table ='tbl_product_images';
    public $timestamps = false;
    protected $fillable = ['product_id', 'product_image_id','product_image_name','product_image_title','product_image_price','default_img','product_image_status','created_on'];
}
