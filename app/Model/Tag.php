<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'description','is_blocked','is_display','topic_count','order'
    ];

    public function topics()
    {
        return $this->belongsToMany('App\Model\Topic', 'topic_tag');
    }
}
