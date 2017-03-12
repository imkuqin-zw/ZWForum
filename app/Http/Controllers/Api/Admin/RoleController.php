<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\ApiController;
use App\Model\Permission;
//use App\Model\Role;
use App\Model\Role;
use App\Repositories\RoleRepository;
//use App\Transformers\Admin\PermsTransformer;
use App\Transformers\Admin\RoleTransformer;
use App\Transformers\Admin\RoleUpdateTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends ApiController
{
    /**
     * @var RoleRepository
     */
    protected $role;

    /**
     * RoleController constructor.
     *
     * @param RoleRepository $role
     */
    public function __construct(RoleRepository $role)
    {
        parent::__construct();
        $this->role = $role;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()->can('list-role'))
            abort(403);
        $roles = $this->role->page(10);
        return $this->respondWithPaginator($roles, new RoleTransformer());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Auth::user()->can('create-role'))
            abort(403);
        $this->validate($request, [
            'name' => 'required|unique:roles',
            'display_name' => 'required',
        ]);

        $roleData = $request->only('name','display_name','description','perms');

        $this->role->createRole($roleData);
        return $this->created();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $roles = $this->role->getById($id);
        return $this->respondWithItem($roles, new RoleUpdateTransformer());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!Auth::user()->can('edit-role'))
            abort(403);
        $roleData['display_name'] = $request->input('display_name');
        $roleData['description'] = $request->input('description');

        $roleData = $request->only('display_name','description','perms');
        $roleData['id'] = $id;
        $this->role->updateRole($roleData);

        return $this->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Auth::user()->can('delete-role'))
            abort(403);
        $role = Role::where('id',$id);
        $role->delete();
        //$this->role->destroy($id);
        return $this->noContent();
    }

    /**
     * Display all the permissions.
     *
     */
    public function showPermissions(){
        $permissions = Permission::select('name','display_name','id','type')->get()->groupBy('type')->toArray();
        return $this->respondWithArray($permissions);
    }

    /**
     *  attach permissions to role.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
//    public function attachRolePerms(Request $request){
//        $this->validate($request, [
//            'roleId' => 'required|integer',
//            'permsId' => 'required|array',
//        ]);
//
//        $roleId = $request->input('roleId');
//        $permsIdArray = $request->input('permsId');
//
//        $role = Role::find($roleId);
//
//        $role->perms()->sync($permsIdArray);
//
//        return $this->created();
//    }
}
