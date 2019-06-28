<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeAddress extends Model
{
    protected $table = 'address_home';
    
    public $timestamps = false;
    
    protected $fillable = ['user_id', 'division_id', 'district_id', 'upazila_id', 'post_office_id', 'others'];

    protected $with = [
        'division', 
        'district',
        'upazila',
        'post_office',
    ];


    public function division()
    {
        return $this->hasOne(Division::class, 'id', 'division_id');
    }

    public function district()
    {
        return $this->hasOne(District::class, 'id', 'district_id');
    }

    public function upazila()
    {
        return $this->hasOne(Upazila::class, 'id', 'upazila_id');
    }

    public function post_office()
    {
        return $this->hasOne(PostOffice::class, 'id', 'post_office_id');
    }
}

