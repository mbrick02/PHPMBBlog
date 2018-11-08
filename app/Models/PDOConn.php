<?php

namespace app\Models;
use PDO;

class PDOConn extends PDO {

	public function __construct($options = []) {
  		$hostNdb = 'mysql:host=' . Config::get('mysql/host') . ';dbname=' . Config::get('mysql/db');
  		$dbuser = Config::get('mysql/username');
  		$dbpw = Config::get('mysql/password');

			$default_options = [
					PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
					PDO::ATTR_EMULATE_PREPARES => false,
					PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			];
			$options = array_replace($default_options, $options);
  		try {
  			// PDO('mysql:host=x;dbname=y', 'usernam', 'pw');$this->_pdo = new PDO('mysql:host='.
  			// ... Config::get('mysql/host') . ';dbname=' .// ... Config::get('mysql/db'),
  			// ...Config::get('mysql/username'), Config::get('mysql/password'));
  			parent::__construct($hostNdb, $dbuser, $dbpw, $options);
  	  } catch(PDOException $e) {
  	  	die($e->getMessage());
  	  }
    }

		public function run($sql, $args = NULL) {
			if (!$args){
					 return $this->query($sql);
			}
			$stmt = $this->prepare($sql);
			$stmt->execute($args);
			/*  example:
			$sth = $dbh->prepare('SELECT name, colour, calories
			    FROM fruit
			    WHERE calories < :calories AND colour = :colour');
			$sth->execute(array(':calories' => $calories,
			 									':colour' => $colour)); *** */
			return $stmt;
		}
	}
