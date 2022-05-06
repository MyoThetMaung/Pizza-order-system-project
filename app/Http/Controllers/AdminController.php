<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function changePassword(Request $request,$id){
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',
        ]);
        $old_password = $request->old_password;
        $new_password = $request->new_password;
        $confirm_password = $request->confirm_password;

        $hashPassword = User::select('password')->where('id', $id)->first();
        
        if (Hash::check($old_password, $hashPassword['password'])) {
            if ($new_password == $confirm_password) {
                if (strlen($new_password) >= 6 && strlen($confirm_password) >= 6) {
                    User::where('id',$id)->update(['password' => Hash::make($new_password)]);
                    return redirect()->route('logout');
                } else {
                    return back()->with('password_number', 'Password must be at least 6 characters');
                }
            } else {
                return back()->with('password_not_match', 'Password do not match');
            }
        } else {
            return back()->with('old_password_incorrect', 'Old password is incorrect');
        }
    }

    public function changePasswordPage(){
        return view('admin.profile.changePassword');
    }

    
}
