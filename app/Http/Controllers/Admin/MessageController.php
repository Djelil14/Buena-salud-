<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.messages.index', compact('messages'));
    }

    public function destroy($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();
        return redirect()->route('admin.messages.index')->with('success', 'Message supprimé.');
    }

    public function replyForm($id)
    {
        $message = ContactMessage::findOrFail($id);
        return view('admin.messages.reply', compact('message'));
    }

    public function sendReply(Request $request, $id)
    {
        $message = ContactMessage::findOrFail($id);
        $data = $request->validate([
            'subject' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
        ]);

        Mail::raw($data['body'], function ($mail) use ($message, $data) {
            $mail->to($message->email)
                ->subject($data['subject']);
        });

        return redirect()->route('admin.messages.index')->with('success', 'Réponse envoyée à '.$message->email);
    }
}


