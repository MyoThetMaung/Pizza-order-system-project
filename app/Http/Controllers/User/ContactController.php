<?php

namespace App\Http\Controllers\User;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function contactCreate(Request $request){
        $request->validate([
            'name' => 'required',
            'email'=> 'required',
            'message' => 'required'
        ]);
        $data = [
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ];
        Contact::create($data);
        return back()->with('success', 'Your message has been sent successfully.');
    }
}
