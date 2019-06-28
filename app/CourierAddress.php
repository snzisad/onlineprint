<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourierAddress extends Model
{
    protected $table = 'address_courier';

    public $timestamps = false;

    protected $fillable = ['user_id', 'courier_id', 'branch_id'];

    protected $with = [
        'courier', 
        'branch',
    ];


    public function courier()
    {
        return $this->hasOne(Courier::class, 'id', 'courier_id');
    }

    public function branch()
    {
        return $this->hasOne(CourierBranch::class, 'id', 'branch_id');
    }
}
