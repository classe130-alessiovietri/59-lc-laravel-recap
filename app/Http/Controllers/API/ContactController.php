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
        try {
            $data = $request->all();

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
