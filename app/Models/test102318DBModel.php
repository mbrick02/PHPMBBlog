<?php

namespace app\Models;
use PDO;
// use DBConnect as DBConn;

class DBModel {
	static protected $_db = null;

	static protected $table = "";
	static protected $columns = [];
	public $errors = [];

	private function __construct($args = []) {
		static::$_db = DBConnect::getInstance();
		static::initializeModel($args);
  }

	protected static function initializeModel($args) {
		// use this in child DB models (e.g. User or Products) to set column vals
		// Called in getInstance() -- every child of DB class needs this method w/unique col
	}

	public static function tableExists($table) {
		$query = "SELECT 1 FROM ? LIMIT 1;";

		if(!$this->query($sql, array($table))->error()) {
			return $this;
		}
		return $false;
	}

  public static function getInstance($args = [], $table = "") {  // PHP OOP Login/R 7/23
			// ***probably DONT need since Singleton is in DBConnect
	}

	public static function getTable() {
		return static::$table;
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
