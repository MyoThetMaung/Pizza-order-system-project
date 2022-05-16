<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminContactController extends Controller
{
    public function contactList(){
        $contacts = Contact::orderBy('contact_id','desc')->paginate(2);
        return view('admin.contact.list',compact('contacts'));
    }

    public function contactSearch(Request $request){
        $contacts = Contact::orWhere('name','like','%'.$request->search.'%')
            ->orWhere('email','like','%'.$request->search.'%')
            ->orWhere('message','like','%'.$request->search.'%')
            ->orderBy('contact_id','desc')->paginate(2);

        $contacts->appends($request->all());
        return view('admin.contact.list',compact('contacts'));
    }
}
