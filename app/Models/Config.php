<?php

namespace app\Models;  // moved from private/classes - namesp cant use keywd private

class Config {
	public static function get($path = null) {
		if ($path) {
			$config = $GLOBALS['config'];

			$path = explode('/', $path);

			foreach($path as $bit) {
				if(isset($config[$bit])) {
					$config = $config[$bit]; // e.g. $bit = 'host' is: $GLOBALS['config']['mysql']['host']
				}
			}
			return $config;
		}
		return false; // if nothing is found
	}
}
