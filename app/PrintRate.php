<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrintRate extends Model
{
    protected $table = 'print_rate';

    public $timestamps = false;

    protected $fillable = [
        'print_color_id', 'print_type_id', 'print_side_id',
        'paper_size_id', 'paper_type_id', 'rate',
    ];

    // protected $with = [
    //     'color',
    //     'print_type',
    //     'print_side',
    //     'paper_size',
    //     'paper_type',
    // ];

    public function color()
    {
        return $this->hasOne(PrintColor::class, 'id', 'print_color_id');
    }

    public function print_type()
    {
        return $this->hasOne(PrintType::class, 'id', 'print_type_id');
    }

    public function print_side()
    {
        return $this->hasOne(Upazila::class, 'id', 'print_side_id');
    }

    public function paper_size()
    {
        return $this->hasOne(PostOffice::class, 'id', 'paper_size_id');
    }

    public function paper_type()
    {
        return $this->hasOne(PostOffice::class, 'id', 'paper_type_id');
    }
}
