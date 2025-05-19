<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:role-access|role-create|role-edit|role-delete', ['only' => ['index',
        'store']]);
        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $role = new Role();
        $data = $role->orderBy('id','DESC')->get();
        return view('admin.role.index', compact('data'));
    }

    public function create()
    {
        $permissions = Permission::pluck('name', 'id')->all();

        return view('admin.role.create', compact('permissions'));
    }

    public function store(Request $request)
    {
            $request->validate([
            'name' => 'required|unique:roles|max:255',
            'permissions' => 'required',
            ]);

        try {
            $data = Role::updateOrCreate(
                ['id' => $request->id],
                ['name' => $request->name],

             );

            if ($request->has('permissions') && is_array($request->permissions)) {
            $data->permissions()->sync($request->permissions);
            }
            $msg = 'Role created successfully.';
            

            return redirect()->route('admin.role.index')->with('success', $msg);
            } catch (\Exception $e) {
            // Handle any exceptions that may occur during the role creation/update
            return redirect()->route('admin.role.index')->with('error', 'Error occurred. Please try again.');
        }
    }

    public function update(Request $request, $id)
    {
    /** update role and permission data and save name and permission */
        $this->validate($request, [
            'name' => 'required',
            'permissions' => 'required',
        ]);
        try {
            $role = Role::find($id);
            $role->name = $request->input('name');
            $role->save();
            $role->permissions()->sync($request->permissions);
            $msg = 'Role updated successfully.';
            return redirect()->route('admin.role.index')->with('success', $msg);
        } catch (\Exception $e) {
        /** Handle other exceptions */
           return redirect()->route('admin.role.index')->with('error', 'Error occurred. Please try again.');
        }
    }

    public function edit($id)
    {
        $data = Role::where('id', decrypt($id))->first();

        $permissions = Permission::pluck('name', 'id')->all();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", decrypt($id))

        ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
        ->all();
        return view('admin.role.edit',compact('data','permissions','rolePermissions'));
    }

    public function destroy($id)
    {
        Role::where('id',decrypt($id))->delete();
        return redirect()->route('admin.role.index')->with('error','Role deleted successfully.');
    }
}
