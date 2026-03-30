<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function contact()
    {
        return view('contact');
    }

    public function insertcontact(Request $request)
    {
        $contacts=new Contact();
        $contacts->name=$request->name;
        $contacts->email=$request->email;
        $contacts->message=$request->message;
        $contacts->save();
        return redirect()->back()->with('success','Message Sent Successfully');

    }
    public function contactlist()
    {
        $contacts = Contact::all();
        return view('admin.contactlist', compact('contacts'));
    }
}
