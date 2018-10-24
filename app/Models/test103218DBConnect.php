<?php

namespace app\Models;
use PDO;

class DBConnect {
	static protected $_instance = null;
/* in DB
	static protected $table = "";
	static protected $columns = [];
	public $errors = [];
*/
	private $_pdo,
		$_query,
		$_error = false,
		$_results,
		$_count = 0;

	private function __construct($args = []) {
		$hostNdb = 'mysql:host=' . Config::get('mysql/host') . ';dbname=' . Config::get('mysql/db');
		$dbuser = Config::get('mysql/username');
		$dbpw = Config::get('mysql/password');

		try {
			// PDO('mysql:host=x;dbname=y', 'usernam', 'pw');
			// $this->_pdo = new PDO('mysql:host=' .
			//  ... Config::get('mysql/host') . ';dbname=' .
			// ... Config::get('mysql/db'),
			// ...Config::get('mysql/username'), Config::get('mysql/password'));
			$this->_pdo = new PDO($hostNdb, $dbuser, $dbpw);

	  } catch(PDOException $e) {
	  	die($e->getMessage());
	  }
  }

  public static function getInstance() {  // PHP OOP Login/R 7/23
		if(!isset(static::$_instance)) {
  		static::$_instance = new static;  // new subclass via static binding
	  }

		return static::$_instance;
  }

  public static function query($sql, $params = array()) {
  	$this->_error = false;

  	if($this->_query = $this->_pdo->prepare($sql)) {
  		if(count($params)) {
  			foreach($params as $param) {
  				$this->_query->bindValue($param, static::$columns[$param]);
  			}
  		}

		  if($this->_query->execute()) {
				$this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
		  	$this->_count = $this->_query->rowCount();
			} else {
				$this->_error = true;
			}
  	}

		return $this;
  }

  public function action($action, $where = array()) {
  	if(count($where) == 3) {
			$operators = array('=', '>', '<', '>=', '<=');
	  	$field = $where[0];
	  	$operator = $where[1];
	  	$value = $where[2];  // TODO: turn value into parameter assoc array: $where[2][$key]

	  	if(in_array($operator, $operators)) {
	  		$sql = "{$action} FROM {static::table} WHERE {$field} {$operator} :{$field}";

	  		if(!$this->query($sql, array($value))->error()) {
	  			return $this;
	  		}
  		}
		} // end if(count($where) == 3)
  	return false;
  }


  public function get($where) {
  	return $this->action('SELECT *', $where);
  }

	public static function getAll($table) {
		return static::query('SELECT * FROM ' . $table);
  }

  public function results() {
  	return $this->_results;
  }

	public function first() {
		return $this->results()[0];
	}

  public function error() {
  	return $this->_error;
  }

  public function count() {
  	return $this->_count;
  }

	public function disconnect() {
		$this->_dbo = null;
	}
}
