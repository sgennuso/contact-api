<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class Sender extends Model
{

	protected $client;
	protected $captchaVerification = "https://www.google.com/recaptcha/api/siteverify";

	protected static $specialFields = [
		'to' => 'required|email',
		'message' => 'required',
		'subject' => 'required',
		'donotfill' => 'is_empty_string',
		'captcha' => 'accepted',
	];

	public function __construct( Client $client )
	{
		$this->client = $client;
	}

	public function verifyCaptcha( $siteKey, $captchaToken )
	{
		$res = $client->post($this->captchaVerification, ['body' => [
			'secret' => $siteKey,
			'response' => $captchaToken,
		]]);

		$response = json_decode($res->getBody());

		return (bool) $response->success;
	}

	public static function autoMessage( Request $request )
	{
		$message = '';

		foreach($request->toArray() as $key => $val ) {
			if( !starts_with($key, '_') )
				continue;

			$message .= self::makeDisplayKey($key) . ": $val \n";
		}

		return $message;
	}

	public static function getSpecialFields()
	{
		return self::$specialFields;
	}

	private static function makeDisplayKey($key)
	{
		return ucfirst(str_replace('_', ' ', trim($key, '_')));
	}
}
