<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ContactMessageMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function message(Request $request)
    {
        /* Prendo i dati */
        $data = $request->all();

        /* Validazione */
        $validator = Validator::make($data, [
            'email' => 'required|email',
            'subject' => 'required|string',
            'content' => 'required|string'
        ], [
            'email.required' => 'La mail e\' obbligatoria',
            'email.email' => 'La mail non e\' valida',
            'subject.required' => 'L\' oggetto della mail e\' obbligatorio',
            'content.required' => 'Il messaggio della mail e\' obbligatori'
        ]);

        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->messages() as $field => $messages) {
                $errors[$field] = $messages[0];
            };

            return response()->json(compact('errors'), 422);
        }

        /* Inserisco per inviare la mail */
        $mail = new ContactMessageMail(
            subject: $data['subject'],
            sender: $data['email'],
            content: $data['content']
        );
        Mail::to(env('MAIL_TO_ADDRESS'))->send($mail);
        return response(null, 204);
    }
}
