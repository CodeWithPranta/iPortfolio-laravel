<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function sendMessage(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        // Get form data
        $name = $request->input('name');
        $email = $request->input('email');
        $subject = $request->input('subject');
        $messageBody = $request->input('message');

        $contactInfo = Contact::first();
        if ($contactInfo)
        {
            $admin_email = $contactInfo->email;
        } else {
            $admin_email = 'codewithpranta@gmail.com';
        }

        // Send email
        Mail::to($admin_email)->send(new \App\Mail\ContactFormMail($name, $email, $subject, $messageBody));

        return redirect()->back()->with('status', 'Your message has been sent. Thank you!');
    }
}
