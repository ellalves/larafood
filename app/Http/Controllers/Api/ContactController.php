<?php

namespace App\Http\Controllers\Api;

use App\Mail\ContactSite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Api\SendContact;
use App\Http\Controllers\ApiController;

class ContactController extends ApiController
{
    public function sendContact(SendContact $request)
    {
        Mail::send(new ContactSite($request->all()));

        return response()->json(['message' => 'success']);
    }
}
