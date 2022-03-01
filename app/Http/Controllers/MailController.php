<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\Contact;

class MailController extends Controller {
   public function submitContact(Request $request) {
      $validated=$request->validate([
         'name'  => 'required|max:100',
         'email' => 'required|email|max:100',
         'phone' => 'required|max:13',
         'message' => 'required|max:300'
      ]);
      $contact =  new Contact;
      $contact->name=$validated['name'];
      $contact->email=$validated['email'];
      $contact->phone=$validated['phone'];
      $contact->message=$validated['message'];
      $contact->save();
      
      Mail::to($validated['email'])
            ->send(new ContactMail($request));
      return  redirect()->back()->with('success_message','Request submitted successfully');
   }
}