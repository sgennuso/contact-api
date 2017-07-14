<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class MailController extends Controller
{
    /**
     * Construt and send email.
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function index(Request $request)
    {
        $mailed = Mail::raw($request->message, function ($request){
            $message
                ->to($request->to)
                ->subject($request->subject);

            $message->setBody($message, $request->html ? 'text/html' : NULL);
        });

        return $mailed;
    }

}
