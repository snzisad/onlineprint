<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrintSide extends Model
{
    protected $table = 'print_side';

    public $timestamps = false;

    protected $fillable = [
        'title'
    ];
}
