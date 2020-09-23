<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BehaviorIndicator extends Model
{
    protected $table = 'behavior_indicators';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
        'code',
        'description'

    ];

}
