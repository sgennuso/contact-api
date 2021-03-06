<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Sender;


class MailController extends Controller
{
    protected $sender;

    public function __construct( Sender $sender )
    {
        $this->sender = $sender;
    }

    /**
     * Construt and send email.
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function index(Request $request)
    {
        if( !isset($request->donotfill) ) {
            $request->add(['donotfill' => '']);
        }

        if( $request->autobody == "true" ) {
            // Generate message
            $message = Sender::autoMessage( $request );
            $request->merge(['message' => $message]);
        }

        // Verify Captcha
        $verified = $this->sender->verifyCaptcha(
            env('RECAPTCHA_SITE_KEY'),
            $request->input('g-recaptcha-response')
        );

        // Validate authorized captcha
        if( $verified ) {
            $request->merge(['captcha' => $verified]);
        }

        // Validate Request
        $this->validate($request, Sender::getSpecialFields());

        try {
            Mail::send([], [], function ($message) use ($request) {
                $message->from(config('mail.from.address'), config('mail.from.name'))
                ->to($request->to)
                ->subject($request->subject)
                ->setBody($request->message, ($request->input('html') == "true") ? 'text/html' : NULL);
            });
        } catch( \Exception $e ) {

            if( $request->input('error_redirect') ) {
                return redirect($request->error_redirect);
            }

            return "Error: " . $e->getMessage();
        }

        if( $request->input('success_redirect') ) {
            return redirect($request->success_redirect);
        }

        return "OK";
    }

}
