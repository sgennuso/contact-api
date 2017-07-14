<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

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

    public function mail(Request $request)
    {
        dd( config('ips.whitelist') );
        $mailed = Mail::raw($request->message, function ($message){
            $message->to($request->to);
        });

        return $mailed;
    }
}
