<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourierBranch extends Model
{
    protected $table = 'courier_branch';

    public $timestamps = false;

    protected $fillable = ['courier_id', 'title'];
}
