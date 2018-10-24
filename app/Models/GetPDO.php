<?php

namespace app\Models;
use PDO;

class GetPDO.php {
	static protected $_pdo;

	private function __construct($args = []) {
  		$hostNdb = 'mysql:host=' . Config::get('mysql/host') . ';dbname=' . Config::get('mysql/db');
  		$dbuser = Config::get('mysql/username');
  		$dbpw = Config::get('mysql/password');

  		try {
  			// PDO('mysql:host=x;dbname=y', 'usernam', 'pw');$this->_pdo = new PDO('mysql:host='.
  			// ... Config::get('mysql/host') . ';dbname=' .// ... Config::get('mysql/db'),
  			// ...Config::get('mysql/username'), Config::get('mysql/password'));
  			static::$_pdo = new PDO($hostNdb, $dbuser, $dbpw);
  	  } catch(PDOException $e) {
  	  	die($e->getMessage());
  	  }
    }

    public static function getInstance($args = [], $table = "", $db = null) {  // PHP OOP Login/R 7/23
      if(!isset(static::$_pdo)) { // test for singleton (on instance of parent w/DB)
        static::$_pdo = new static;  // new subclass via static binding
      }
      return static::$_pdo;
    }
  }
