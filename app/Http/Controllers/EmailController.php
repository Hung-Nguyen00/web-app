<?php

namespace App\Http\Controllers;

use App\Mail\sendMail;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function index(){
        $email = auth()->user()->email;
        $details = [
            'title' => 'Mail from thanhhung041100@gmail.com',
            'body' => 'This is the firest Email',
        ];
        \Mail::to($email)->send(new sendMail($details));

        dd('Email is sent');
    }
}
