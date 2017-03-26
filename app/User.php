<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Nicolaslopezj\Searchable\SearchableTrait;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    use EntrustUserTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','is_admin','is_banned',
        'github_name','real_name','company','city','weibo_name','weibo_link',
        'twitter_account','personal_website','description','portrait_min','portrait_mid','portrait_max'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    use SearchableTrait;
    protected $searchable = [
        'columns' => [
            'users.name' => 10,
            'users.real_name' => 10,
            'users.description' => 10,
        ],
    ];

}
