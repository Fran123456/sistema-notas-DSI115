<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class inventoryProduct extends Model
{
    protected $table = 'inventory_products';
    public $timestamps = false;
    protected $fillable = [
      'id','code','img','model','name','category_id','state','lastStock','actualStock',
    ];





}
