<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:permission-access|permission-create|permission-edit|permission-delete',
        ['only' => ['index','store']]);
        $this->middleware('permission:permission-create', ['only' => ['create','store']]);
        $this->middleware('permission:permission-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data = Permission::orderBy('id','DESC')->get();
        return view('admin.permission.index',compact('data'));
    }

    public function create()
    {
        return view('admin.permission.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name|max:255',
        ]);
        Permission::updateOrCreate(
            [
                'id'=>$request->id
            ],[
                'name'=>$request->name,
            ]
        );
        if($request->id){
            $msg = 'Permission updated successfully.';
        }else{
            $msg = 'Permission created successfully.';
        }
        return redirect()->route('admin.permission.index')->with('success',$msg);
    }

    public function edit($id)
    {
        $data = Permission::where('id',decrypt($id))->first();
        return view('admin.permission.edit',compact('data'));
    }

    public function destroy($id)
    {
        Permission::where('id',decrypt($id))->delete();
        return redirect()->route('admin.permission.index')->with('error','Permission deleted successfully.');
    }
}
