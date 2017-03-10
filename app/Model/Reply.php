<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $table = 'replies';
    protected $fillable = ['topic_id','content','is_blocked','user_id'];

    public function topic(){
        return $this->belongsTo('App\Model\Topic');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

}
