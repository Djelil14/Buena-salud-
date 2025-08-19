<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        ContactMessage::create($validated);

        // Envoi d'email à l'admin si configuré
        $to = env('CONTACT_NOTIFY_EMAIL');
        if ($to) {
            $data = $validated;
            Mail::raw(
                "Nouveau message de contact\n\nNom: {$data['name']}\nEmail: {$data['email']}\nSujet: ".($data['subject'] ?? '-')."\n\n{$data['message']}",
                function ($message) use ($to) {
                    $message->to($to)->subject('Nouveau message de contact');
                }
            );
        }

        return redirect()->route('contact')->with('success', 'Merci pour votre message, nous vous répondrons rapidement.');
    }
}


