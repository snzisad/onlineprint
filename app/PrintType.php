<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrintType extends Model
{
    protected $table = 'print_type';

    public $timestamps = false;

    protected $fillable = [
        'title'
    ];
}
