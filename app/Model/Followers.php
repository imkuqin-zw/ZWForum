<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Followers extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user_id', 'follower_id'
    ];

//    public function followers()
//    {
//        return $this->belongsTo('App\User', 'follwer_id', 'id');
//    }
}
