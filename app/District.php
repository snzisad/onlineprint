<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'district';

    public $timestamps = false;

    protected $fillable = ['division_id', 'title'];
}
