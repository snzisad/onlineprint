<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostOffice extends Model
{
    protected $table = 'post_office';

    public $timestamps = false;
    
    protected $fillable = ['upazila_id','title'];
}
