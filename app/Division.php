<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $table = 'division';

    public $timestamps = false;

    protected $fillable = ['title'];
}
