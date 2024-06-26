<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'your-name' => 'required',
            'your-email' => 'required|email',
            'your-message' => 'required',
        ]);

        // Store the contact form data
        $contact = new Contact();
        $contact->name = $request->input('your-name');
        $contact->email = $request->input('your-email');
        $contact->subject = $request->input('your-subject');
        $contact->message = $request->input('your-message');
        $contact->save();

        // Send an email
        Mail::send('emails.contacts', ['contacts' => $contact], function ($m) use ($contact) {
            $m->from('comboys1k@gmail.com', 'Huu Nguyen');
            $m->to($contact->email, $contact->name)->subject('Contact Form Submission');
        });

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }

    public function index()
    {
        $contacts = Contact::all();
        return view('admin.contacts.index', compact('contacts'));
    }

    public function showReplyForm($id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin.contacts.reply', compact('contact'));
    }

    public function reply(Request $request, $id)
    {
        $request->validate([
            'subject' => 'required',
            'message' => 'required',
        ]);

        $contact = Contact::findOrFail($id);

        $replyData = [
            'subject' => $request->input('subject'),
            'messageContent' => $request->input('message'),
            'contact' => $contact,
        ];

        // Gửi email trả lời
        Mail::send('emails.reply', ['contact' => $contact, 'messageContent' => $request->input('message')], function ($m) use ($contact, $request) {
            $m->from('comboys1k@gmail.com', 'Huu Nguyen');
            $m->to($contact->email, $contact->name)->subject($request->input('subject'));
        });
        $contact->status = 'replied';
    $contact->save();

        return redirect()->route('admin.contacts.index')->with('success', 'Trả lời thành công!');
    }

}
