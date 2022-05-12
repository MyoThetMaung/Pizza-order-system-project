<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function contactCreate(Request $request){
        $data = [
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ];
        dd($data);
    }
}
