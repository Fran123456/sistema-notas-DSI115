<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    protected $table = 'degrees';
	protected $fillable = [
	  'id','degree','section','turn','active'
	];

}
