<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function profile()
    {
        $user = User::where('id',Auth::user()->id)->first();
        return view('admin.profile.index',compact('user'));
    }

    public function updateProfile(Request $request,$id){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);
        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ];
        User::where('id',$id)->update($updateData);
        return redirect()->route('admin#profile')->with('success','Profile Updated Successfully');
    }

    public function changePassword($id){
        dd($id);
    }
}
