<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upazila extends Model
{
    protected $table = 'upazila';

    public $timestamps = false;

    protected $fillable = [
        'title', 'district_id'
    ];
}
