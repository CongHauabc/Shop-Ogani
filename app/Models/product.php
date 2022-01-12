<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    public $timestamps = false;
    protected $fillable =['product_name','product_quantity','product_sold','category_id','brand_id','product_desc','product_content','product_price','product_status','product_images'];
    protected $primaryKey = 'product_id';
    protected $table = 'tbl_product';
}
