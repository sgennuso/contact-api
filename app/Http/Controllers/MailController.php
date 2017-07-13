<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function mail()
    {
        $mailed = Mail::raw('Testing', function ($message){
            $message->to('freshbrewedweb@gmail.com');
        });

        return $mailed;
    }
}
