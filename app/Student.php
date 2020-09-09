<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
	protected $table = 'students';
	protected $fillable = [
      'id',
      'name',
      'lastname',
      'age',
      'gender',
      'phone',
      'address',
      'parent_name',
      'parent_DUI',
      'status'
	];

}
