<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class inventoryCategory extends Model
{
   // use HasFactory;
    protected $table = 'inventory_category';
    public $timestamps = false;
    protected $fillable = [
      'id','name','description'
    ];
}
