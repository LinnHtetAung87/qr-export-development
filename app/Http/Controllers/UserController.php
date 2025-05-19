<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:user-access|user-create|user-edit|user-delete', ['only' => ['index',
        'store']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $user = new User();
        $data = $user->orderBy('name','ASC')->get();
        return view('admin.user.index', compact('data'));
    }
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
     {
     /** create new user data with role using compact */
        $roles = Role::pluck('name', 'name')->all();

        return view('admin.user.create', compact('roles'));
     }

     /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
     {
     /** store or save user data */
     $this->validate($request, [
            'name' => 'required|unique:users,name',
            'email' => 'required|unique:users,email',

            'profile_photo' => 'image|max:2048', // Adjust validation rules as needed



         ]);
     try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->assignRole($request->input('roles'));
            $user->save();
            $msg = 'User created successfully.';


            return redirect()->route('admin.user.index')->with('success', $msg);


         } catch (\Exception $e) {
     /** Handle other exceptions */
         return redirect()->route('admin.user.index')->with('error', 'Error occurred. Please try again.');
         }
     }

     /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
     public function edit($id)
     {
     /** edit user data with role using compact */
        $user = User::find(decrypt($id));

        $roles = Role::pluck('name', 'name')->all();

        $userRoles = $user->roles->pluck('name', 'name')->all();


        return view('admin.user.edit', compact('user', 'roles', 'userRoles'));
     }

     /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, $id)
     {
     /** update user data with role */
     try {

            $user = User::find($id);

            if ($request->hasFile('profile_photo')) {
                $imagePath = $request->file('profile_photo')->store('user_photos', 'public');
                $user->profile_photo_path = $imagePath;
            }


            $user->name = $request->name;
            $user->email = $request->email;
            DB::table('model_has_roles')->where('model_id', $id)->delete();
            $user->assignRole($request->roles);

            $user->save();

            $user = User::all();
            $msg = 'User updated successfully.';


            return redirect()->route('admin.user.index')->with('success', $msg);
         } catch (\Exception $e) {
            /** Handle other exceptions */
            return redirect()->route('admin.user.index')->with('error', 'Error occurred. Please try again.');
         }
     }

     /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
     public function destroy($id, Request $request)
     {
        User::where('id',decrypt($id))->delete();
        return redirect()->route('admin.user.index')->with('error','User deleted successfully.');
     }
}
