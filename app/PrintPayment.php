<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrintPayment extends Model
{
    protected $table = 'print_payment';

    protected $fillable = ['sequence_id', 'account', 'trnx_id', 'amount'];

    protected $with = [
        'order',
    ];

    public function order()
    {
        return $this->hasOne(OrderSequence::class, 'id', 'sequence_id');
    }
}
