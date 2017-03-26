<?php

namespace App\Applications\Site\Http\Controllers;

use jeremykenedy\LaravelRoles\Models\Permission;
use jeremykenedy\LaravelRoles\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RolesManagementController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return $this->view('rolesmanagement.show-roles',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions=Permission::all();
        return $this->view('rolesmanagement.show-role',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = Role::create($request->except(['permission','_token']));

        foreach ($request->permission as $key=>$value){
            $role->attachPermission($value);
        }

        return redirect()->route('role.index')->withMessage('role created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        $currentPermission = [];

        foreach ($role->permissions as $role_permission) {
            $currentPermission[] = $role_permission;
        }

        $data = [
            'role'          => $role,
            'currentPermission' => $currentPermission
        ];

        return $this->view('rolesmanagement.show-role')->with($data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = Permission::all();
        $role_permissions = $role->perms()->pluck('permission_id')->toArray();

         return $this->view('rolesmanagement.edit-role',compact(['role','role_permissions','permissions']));
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
        $role = Role::find($id);
        $role->name=$request->name;
        $role->display_name=$request->display_name;
        $role->description=$request->description;
        $role->save();

        DB::table('permission_role')->where('role_id',$id)->delete();

        foreach ($request->permission as $key=>$value){
            $role->attachPermission($value);
        }

        return redirect()->route('rolesmanagement.show-roles')->withMessage('role Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        DB::table("roles")->where('id',$id)->delete();
        return back()->withMessage('Role Deleted');

    }
}
