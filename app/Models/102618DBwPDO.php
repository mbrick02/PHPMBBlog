<?php

namespace app\Models;
use PDO;

abstract class DB {
	static protected $_instance = null;
	static protected $_pdo;

	static protected $table;
	static protected $columns = [];
	public $errors = [];

	static protected $_query,
		$_error = false;
	private	$_results,
		$_count = 0;

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

	public static function tableExists($table) {
		$query = "SELECT 1 FROM ? LIMIT 1;";

		if(!self::query($sql, array($table))->error()) {
			return true;
		}
		return $false;
	}

  public static function getInstance($args = [], $table = "", $db = null) {  // PHP OOP Login/R 7/23
		if(null != $db){
			static::$_pdo = $db::$_pdo;  // if ever need to set to global $db::$_pdo
		}

		if(!isset(static::$_instance)) { // test for singleton (on instance of parent w/DB)
  		static::$_instance = new static;  // new subclass via static binding
	  }

		static::initializeModel($args);
		if (!empty($args)) { // DEBUG ** 10/25
			// var_dump($args);
			// echo "<br />called by: " . get_called_class() . "<br>";
			// echo "Table: " .static::$table . "<br>Instance: ";
			// var_dump(static::$_instance); // ::$_pdo
			// // die();
			// die();
		}

		return static::$columns;
		// static::$_instance;
  }

	public static function getTable() {
		return static::$table;
	}

	protected static function initializeModel($args) {
		// most child classes should have this
	}

  public static function query($sql, $params = array()) {
  	self::$_error = false;

  	if(self::$_query = self::$_pdo->prepare($sql)) {
  		if(count($params)) {
  			foreach($params as $param) {
  				self::_query->bindValue($param, static::$columns[$param]);
  			}
  		}

		  if(self::$_query->execute()) {
				self::$_results = self::$_query->fetchAll(PDO::FETCH_OBJ);
		  	self::$_count = self::$_query->rowCount();
			} else {
				self::$_error = true;
			}
  	}

		if (self::$_error == true){
			return false;
		}

		return ['results' => self::$_results,
						'count' => self::$_count,
						];
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

	protected function validate() {
    $this->errors = [];
    // Add custom validations

    return $this->errors;
  }

	// *************NOT TESTED 9/27/18******Create
	public function create($formVals) {
		 	if (static::validate()){
				$strFlds = implode(", ", static::$columns);
			 	$aryParams = static::$columns;
			 	foreach ($aryParams as &$value) {
			 		$value = ':'.$value;
			 	}
				var_dump($aryParams);
				echo "\n From DB.php create";
				die(); // DEBUG** 10/21/18

			 	unset($value);
			 	$strParams = implode(", ", $aryParams);

			 	// combine so $fld_param_fld_ary[':fieldx'] = 'fieldx'
			 	$fld_param_fld_ary = array_combine($aryParams, $aryFlds);

				 // INSERT INTO table (key, key) VALUES ('value', 'value') use PDO
				 $sql = "INSERT INTO " . static::$table ." (";
				 // $sql .= 'username', 'password', 'first_name', 'last_name';
				 $sql .= $strFlds;
				 $sql .= ") VALUES (";
				 // $sql .= ":username, :password, :first_name, :last_name" . ")";
				 $sql .= $strParams . ")";

				 echo $sql;
				 die();

				 $this->query($sql, $aryFlds);
				 $field_val_ary = array();
				 foreach($fld_param_fld_ary as $key => $value) {
				 	$field_val_ary[$key] = $this->{$value};
				 }

				 if ($this->query($sql, $field_val_ary)) {
				 	$this->column['id'] = $this->_pdo->lastInsertId();
				 	return true;
				 }
			}
			return false;
		}  // end public create()

	// *****************end CREATE

  public function get($where) {
  	return $this->action('SELECT *', $where);
  }

// ?*? untested 9/22/18
	public function getFieldsStr( $fieldsStr, $where) {
  	return $this->action("SELECT {$fieldsStr}", $where);
  }

  public static function getAll() {
		/* output are query records AND $results['rowCount'] OR $results['error'] */
		$sql = 'SELECT * FROM ' . static::$table;// $table;
		$query = self::$_pdo->prepare($sql);
		if($query->execute()) {
			$results['records'] = $query->fetchAll(PDO::FETCH_OBJ);
			$results['rowCount'] = $query->rowCount();
		} else {
			$results['error'] = true;
		}
		return $results;
  }

  public function delete($where) {
  	return $this->action('DELETE', $where);
  }

  public function results() {
  	return self::_results;
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
