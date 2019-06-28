<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrintColor extends Model
{
    protected $table = 'print_color';

    public $timestamps = false;

    protected $fillable = ['title'];
}
