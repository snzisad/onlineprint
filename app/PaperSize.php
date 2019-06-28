<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaperSize extends Model
{
    protected $table = 'paper_size';

    public $timestamps = false;

    protected $fillable = ['title'];
}
