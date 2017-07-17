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
        $this->validate($request, [
            'to' => 'required|email',
            'html' => 'required',
            'message' => 'required',
            'subject' => 'required',
        ]);

        try {
            Mail::send([], [], function ($message) use ($request) {
                $message->to($request->to)
                ->subject($request->subject)
                ->setBody($request->message, $request->html ? 'text/html' : NULL);
            });
        } catch( \Exception $e ) {
            return "Error";
        }

        return "OK";
    }

}
