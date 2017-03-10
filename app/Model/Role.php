<?php

namespace App\Model;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'id', 'display_name','description'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    //protected $hidden = ['created_at', 'updated_at'];

//    public function perms()
//    {
//    }
}
