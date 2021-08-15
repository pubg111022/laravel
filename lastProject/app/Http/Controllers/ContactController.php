<?php

namespace App\Http\Controllers;

use App\Mail\RepContact;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    function index(){
        $contact = Contact::get();
        return view('admin.FormContact.index',compact('contact'));
    }
    function contact_reply($id){
        $info = Contact::find($id);
        return view('admin.FormContact.edit',compact('info'));
    }
    function post_reply(Request $req,$id){
        $reply = $req->reply;
        $_SESSION["reply"] = $reply;
        $contact = Contact::find($id);
        $contact->update([
           'status'=>1
        ]);
        Mail::to($contact->email)->send(new RepContact());
       return redirect()->back();
    }
}
