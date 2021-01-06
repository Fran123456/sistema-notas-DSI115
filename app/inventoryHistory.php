<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class inventoryHistory extends Model
{
    protected $table = 'inventory_history';
   // public $timestamps = false;
    protected $fillable = [
      'id','code','reason','quantity','responsable','product_id','lastStock','actualStock',
    ];

}
