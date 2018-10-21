<?php

namespace app\Models;
use PDO;

class DB {
	static protected $_instance = null;

	static protected $table = "";
	static protected $columns = [];
	public $errors = [];

	private $_pdo,
		$_query,
		$_error = false,
		$_results,
		$_count = 0;

	protected function __construct() {
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

  public static function getInstance($args = [], $table = "") {  // PHP OOP Login/R 7/23
  	if(!isset(static::$_instance)) {
  		static::$_instance = new static;  // new subclass via static binding
			// || ($table != "" && $table != static::$table)  // ?allow for table change?
			// static::$table = $table; // this should be set in child Model
	  }
	  return static::$_instance;
  }

  public function query($sql, $params = array()) {
  	$this->_error = false;

  	if($this->_query = $this->_pdo->prepare($sql)) {
  		$x = 1;
  		if(count($params)) {
  			foreach($params as $param) {
  				$this->_query->bindValue($x, $param);
  				$x++;
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
	  	$value = $where[2];

	  	if(in_array($operator, $operators)) {
	  		$sql = "{$action} FROM {static::table} WHERE {$field} {$operator} ?";

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
	public function create() {

		 	$strFlds = implode(", ", static::$columns);
		 	$aryParams = static::$columns;
		 	foreach ($aryParams as &$value) {
		 		$value = ':'.$value;
		 	}
			var_dump($aryParams)
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

			 $field_val_ary = array();
			 foreach($fld_param_fld_ary as $key => $value) {
			 	$field_val_ary[$key] = $this->{$value};
			 }

			 /* examp: array(':field1' => $this->field1,':field2' => $this->field2); */
			 // $field_val_ary = array(':username' => 'ausername', ...

			 $sth = $db->exec_qry($sql, $field_val_ary);  // statement handler

			 if ($sth) {
			 	$this->column['id'] = $db->pdo->lastInsertId();
			 	return true;
			 } else {
			 	return false;
			 }

		}  // end public create()

	// *****************end CREATE

  public function get($where) {
  	return $this->action('SELECT *', $where);
  }

// ?*? untested 9/22/18
	public function getFieldsStr( $fieldsStr, $where) {
  	return $this->action("SELECT {$fieldsStr}", $where);
  }

  public function getAll() {
  	return $this->query('SELECT * FROM ' . static::$table);
  }

  public function delete($where) {
  	return $this->action('DELETE', $where);
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
