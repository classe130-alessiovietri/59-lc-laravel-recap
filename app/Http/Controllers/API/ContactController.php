<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Contact;

class ContactController extends Controller
{

    public function newContact(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:3|max:64',
            'email' => 'required|email|min:5|max:255',
            'message' => 'required|min:3|max:2048'
        ]);

        try {
            // $contact = new Contact();
            // $contact->name = $data['name'];
            // $contact->email = $data['email'];
            // $contact->message = $data['message'];
            // $contact->save();

            /*
                OPPURE
            */

            $contact = Contact::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Ok'
            ], 200);
        }
        catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Dati non validi',
                'error' => $e->getMessage(),
            ], 400);
        }
    }

}
