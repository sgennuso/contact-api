<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Sender extends Model
{
	protected static $specialFields = [
		'to' => 'required|email',
		'message' => 'required',
		'subject' => 'required',
		'donotfill' => 'is_empty_string',
	];

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
