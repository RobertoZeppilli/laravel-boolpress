<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

use App\Lead;
use App\Mail\ContactMessage;

class LeadController extends Controller
{
    public function store(Request $request) {

        // richiesta dati provenienti dal form
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|max:80',
            'email' => 'required|max:80',
            'message' => 'required'
        ]);

        // validazione
        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ]);
        }

        // creazione istanza
        $lead = new Lead();

        $lead->fill($data);

        $lead->save();

        Mail::to('admin@sito.it')->send(new ContactMessage($lead));

        return response()->json([
            'success' => true
        ]);

    }
}
