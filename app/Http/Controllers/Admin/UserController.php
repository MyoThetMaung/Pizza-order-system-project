<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function userList(){
        $users = User::where('role','user')->paginate(2);
        return view('admin.users.userList',compact('users'));
    }

    public function adminList(){
        $users = User::where('role','admin')->paginate(2);
        return view('admin.users.adminList',compact('users'));
    }

    public function userListSearch(Request $request){
        $users = $this->search($request,'user');
        return view('admin.users.userList',compact('users'));
    }

    public function adminListSearch(Request $request){
        $users = $this->search($request,'admin');
        return view('admin.users.userList',compact('users'));
    }

    protected function search($request, $role){
        $key = $request->search;
        $users = User::where('role', $role)
                        ->where(function ($query) use ($key) {
                            $query  ->orwhere('name','like','%'.$key.'%')
                                    ->orwhere('email','like','%'.$key.'%')
                                    ->orwhere('phone','like','%'.$key.'%')
                                    ->orwhere('address','like','%'.$key.'%');
                        })->paginate(2);
        $users->appends($request->all());
        return $users;
    }

    public function userListDelete($id){
        $user = User::find($id);
        $user->delete();
        return redirect()->route('admin#userList')->with('success','User deleted successfully');
    }

    public function adminListDelete($id){
        $user = User::find($id);
        $user->delete();
        return redirect()->route('admin#adminList')->with('success','Admin deleted successfully');
    }


}
