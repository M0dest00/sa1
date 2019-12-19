<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $roles = Role::all();
      return view('admin.roles.all', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $permissions = Permission::all()->pluck('name');
      return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request, [
          'name' => 'required|max:255',
      ]);
      if (count($request->permissions) == 0) {
        return redirect()->back()->with('error','Permissions field is required');
      }
      $role = Role::create(['name' => $request->name]);
      $permissions = $request->permissions;
      foreach ($permissions as $permission) {
        $role->givePermissionTo($permission);
      }
      return redirect()->route('role.index')->with('message','Role Created Succefully');


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
      $permissions = $role->permissions;
      return view('admin.roles.view', compact('role','permissions'));

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
      $permissions = Permission::all()->pluck('name');
      return view('admin.roles.edit', compact('role','permissions'));
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
      $this->validate($request, [
          'name' => 'required|max:255',
      ]);
      if (count($request->permissions) == 0) {
        return redirect()->back()->with('error','Permissions field is required');
      }
      $role = Role::find($id);
      $role->update(['name' => $request->name]);
      $permissions = $request->permissions;
      $role->syncPermissions($permissions);
      return redirect()->route('role.index')->with('message','Role Updated Succefully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $role = Role::find($id);
      $role->delete();
      return redirect()->route('role.index')->with('message','Role Deleted Succefully');

    }
}
