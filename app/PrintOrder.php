<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrintOrder extends Model
{
    protected $table = 'print_order';

    protected $fillable = ['sequence_id', 'page', 'set', 'total_page', 'color_id', 'print_type_id', 'print_side_id', 'paper_size_id', 'paper_type_id', 'rate', 'price', 'status'];

    protected $with = [
        'file',
        'color',
        'print_type',
        'print_side',
        'paper_size',
        'paper_type',
    ];

    public function file()
    {
        return $this->hasOne(PrintFiles::class, 'order_id', 'id');
    }

    public function order_sequnece()
    {
        return $this->hasOne(OrderSequence::class, 'id', 'sequence_id');
    }

    public function color()
    {
        return $this->hasOne(PrintColor::class, 'id', 'color_id');
    }

    public function print_type()
    {
        return $this->hasOne(PrintType::class, 'id', 'print_type_id');
    }

    public function print_side()
    {
        return $this->hasOne(PrintSide::class, 'id', 'print_side_id');
    }

    public function paper_size()
    {
        return $this->hasOne(PaperSize::class, 'id', 'paper_size_id');
    }

    public function paper_type()
    {
        return $this->hasOne(PaperType::class, 'id', 'paper_type_id');
    }
}
