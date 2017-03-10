<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 2017/2/10
 * Time: 14:33
 */

namespace App\Repositories;


use App\Model\Role;
use Illuminate\Support\Facades\DB;

class RoleRepository extends BaseRepository
{

    /**
     * RoleRepository constructor.
     *
     * @param Role $role
     */
    public function __construct(Role $role)
    {
        $this->model = $role;
    }

    /**
     * Store a newly created role resource in storage and atatch to the permissions.
     *
     * @param Array[] $input
     */
    public function createRole($input){
        DB::transaction(function ($input) use ($input) {
            try {
                $role = $this->create($input);
                $role->perms()->sync($input['perms']);
            } catch (\Exception $e) {
                throw $e;
            }
        });
    }

    public function updateRole($input){

        DB::transaction(function ($input) use ($input) {
          try{
              $role = $this->update($input['id'],$input);
              $role->perms()->sync($input['perms']);
          }catch (\Exception $e){
              throw $e;
          }
        });
    }

}