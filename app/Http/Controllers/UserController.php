<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view user', ['only' => ['index']]);
        $this->middleware('permission:create user', ['only' => ['create','store']]);
        $this->middleware('permission:update user', ['only' => ['update','edit']]);
        $this->middleware('permission:delete user', ['only' => ['destroy']]);
    }

    public function index()
{
    if (auth()->user()->hasRole('super-admin')) {
        $users = User::all(); // super-admin can see everyone
    } else {
        $users = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'super-admin');
        })->get(); // others can't see super-admins
    }

    return view('role-permission.user.index', ['users' => $users]);
}


    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('role-permission.user.create', ['roles' => $roles]);
    }

    public function store(Request $request)
    {
        if (in_array('super-admin', $request->roles) && !auth()->user()->hasRole('super-admin')) {
            abort(403, 'You cannot assign the super-admin role.');
        }
    
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|max:20',
            'roles' => 'required'
        ]);
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    
        $user->syncRoles($request->roles);
    
        return redirect('/users')->with('status','User created successfully');
    }
    
    public function edit(User $user)
    {
        if ($user->hasRole('super-admin') && !auth()->user()->hasRole('super-admin')) {
            abort(403, 'Unauthorized to edit this user.');
        }
    
        $roles = Role::pluck('name','name')->all();
        $userRoles = $user->roles->pluck('name','name')->all();
        return view('role-permission.user.edit', [
            'user' => $user,
            'roles' => $roles,
            'userRoles' => $userRoles
        ]);
    }

    public function update(Request $request, User $user)
    {
        if ($user->hasRole('super-admin') && !auth()->user()->hasRole('super-admin')) {
            abort(403, 'Unauthorized to update this user.');
        }
    
        if (in_array('super-admin', $request->roles) && !auth()->user()->hasRole('super-admin')) {
            abort(403, 'You cannot assign the super-admin role.');
        }
    
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|max:20',
            'roles' => 'required'
        ]);
    
        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];
    
        if(!empty($request->password)){
            $data['password'] = Hash::make($request->password);
        }
    
        $user->update($data);
        $user->syncRoles($request->roles);
    
        return redirect('/users')->with('status','User Updated Successfully');
    }

    public function destroy($userId)
    {
        $user = User::findOrFail($userId);
    
        if ($user->hasRole('super-admin') && !auth()->user()->hasRole('super-admin')) {
            abort(403, 'Unauthorized to delete this user.');
        }
    
        $user->delete();
    
        return redirect('/users')->with('status','User Deleted Successfully');
    }
    
}