<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $table = 'pictures';
    
    public $timestamps = false;

    
    protected $fillable = ['user_id','picture'];

    public function profile_picture()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
