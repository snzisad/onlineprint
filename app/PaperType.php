<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaperType extends Model
{
    protected $table = 'paper_type';

    public $timestamps = false;

    protected $fillable = ['title'];
}
