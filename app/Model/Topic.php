<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'reply_at','title','content','user_id','view_count','vore_count','reply_count','istop','order','is_top','is_blocked','is_excellent','category_id'
    ];

    public function category()
    {
        return $this->belongsTo('App\Model\Category');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Model\Tag', 'topic_tag');
    }

    public function replies(){
        return $this->hasMany('App\Model\Reply');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
