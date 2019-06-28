<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderSequence extends Model
{
    protected $table = 'order_sequence';

    protected $fillable = ['user_id', 'total_page', 'price'];

    // protected $with = [
    //     'items', 'user', 'payment'
    // ];

    public function items()
    {
        return $this->hasMany(PrintOrder::class, 'sequence_id', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function payment()
    {
        return $this->hasOne(PrintPayment::class, 'sequence_id', 'id');
    }
}
