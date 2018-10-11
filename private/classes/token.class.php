<?php
class Token {
  // PHP Tools -OOP Login/Register class/Token.php
	public static function generate() {
		// use Config library get() for token_name put in session
		return Session::put(Config::get('session/token_name'), md5(uniqid()));
	}


	public static function check($token) {
		$tokenName = Config::get('session/token_name');

		if(Session::exists($tokenName) && $token === Session::get($tokenName)) {
		Session::delete($tokenName):
		return true;
	}

	return false;
	}
}
