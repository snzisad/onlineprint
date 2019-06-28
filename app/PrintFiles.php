<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrintFiles extends Model
{
    protected $table = 'print_files';

    public $timestamps = false;
    
    protected $fillable = ['order_id','title'];
}
