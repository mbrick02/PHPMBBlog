<?php

namespace app\Models;
use PDO;

abstract class DB {
	static protected $_pdo = null;
	static protected $table;
	static protected $columns = [];
	static protected $notInDBCols = array();
	static protected $uniqueFlds = array();
	public $errors = [];
	// public $fields = []; // for instance of columns ????

	static protected $_query, // pdo stmt static??
		$_error = false;
	static private	$_results,
		$_count = 0;

	private function __construct($args = []) {
		// *** PDO DB setup handled by PDOConn
  }

	public static function set_PDO($pdo){
		static::$_pdo = $pdo;
	}

	public static function tableExists($table) {
		$query = "SELECT 1 FROM ? LIMIT 1;";

		if(!static::query($sql, array($table))->error()) {
			return true;
		}
		return $false;
	}

  public static function getInstance($db, $args = [], $table = "") {  // PHP OOP Login/R 7/23
		// DON'T USE Singleton anymore
		// if(!isset(static::$_pdo)) { // test for singleton (on instance of parent w/DB)
  	// 	static::$_pdo = PDOConn::getInstance();  // new subclass via static binding
	  // }

		static::set_PDO($db);  // should always be global $db

		static::initializeModel($args);

		$dbObject = new static;

		return $dbObject;
  }

	public static function getTable() {
		return static::$table;
	}

	public function getCols() {  // ** 11/1/18 Probably just for DEBUG
		return static::$columns;
	}

	protected static function initializeModel($args) {
		// most child classes should have this
	}

	public function putFormValsSess(){
		/* store db col/field values into session under table */
		global $session;
		$aryFrmVals = array();
		foreach (static::$columns as $key => $value) {
			if (!empty($value)) {
				$aryFrmVals[$key] = $value;
			}
		}
		$session->put(static::$table, $aryFrmVals); // e.g users['']
	}

	public function restoreFormValsSessCols($excludeAry = []){
		/* retrieve session vals under table into db col/field values */
		global $session;
		$formValsAry = static::$table;
		if ($session->exists($formValsAry)) {
			foreach (static::$columns as $key => &$value) {
				if (in_array($key, $excludeAry)) { continue; } // eg. exclude password
				if (isset($session->get($formValsAry)[$key])){
					$value = $session->get($formValsAry)[$key];
				}
			}
		}
	}

  public static function query($sql, $params = array()) {
		global $db;
		self::$_error = false;
		if (is_null(static::$_pdo)) static::set_PDO($db);

  	if($queryStmt = static::$_pdo->prepare($sql)) {
  		// if(count($params)) {
  		// 	foreach($params as $param) {
  		// 		$queryStmt->bindValue($param, static::$columns[$param]);
  		// 	}
  		// }
// $sth->execute(array(':calories' => $calories, ':colour' => $colour));
		  if($queryStmt->execute($params)) {
				self::$_results = $queryStmt->fetchAll(PDO::FETCH_OBJ);
		  	self::$_count = $queryStmt->rowCount();
			} else {
				self::$_error = true;
			}
  	}

		if (self::$_error == true){
			return false;
		}
		self::$_query = $queryStmt;
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

	  		if(!self::$_query($sql, array($value))->error()) {
	  			return $this;
	  		}
  		}
		} // end if(count($where) == 3)
  	return false;
  }

	private function testUniqFldVals() {
		$where = "";
		foreach (static::$uniqueFlds as $field) {
			$where = "{$field} = static::$columns[$field]";
			$sql = "SELECT * FROM " . static::$table . " WHERE " . $where;

			static::query($sql);
		}
		if (!empty($where)) {
			RUNQueryTestForDupOfUniqFld  static::query($sql)
			ifDupRecordErrInErrors
		}
	}

	public function validate() {
    // $this->errors = [];  // don't want to zero out the errors array
    // use custom validations in child models befor calling this/parent

		$this->testUniqFldVals();

    // return $this->errors;  // test for errors elsewhere
  }

	public function create($formVals) {
		 	if ($this->validate()){
				/* Use this function to remove specific arrays of keys without modifying the original array
					function array_except($array, $keys) {return array_diff_key($array, array_flip((array) $keys));}  */
				// take out columns like 'id' that aren't being created in db
				$dbTblFlds = array_diff_key(static::$columns, array_flip(static::$notInDBCols), array_flip(array("id")));
				$strFldNames = implode(", ", array_keys($dbTblFlds));
			 	$aryParams = $dbTblFlds;
			 	foreach ($aryParams as $key => &$value) {
			 		$value = ':'. $key;
			 	}

			 	unset($value); // clear for future use
			 	$strParams = implode(", ", $aryParams);

				$aryFlds = array_keys($dbTblFlds);

			 	// xx combine so $fld_param_fld_ary[':fieldx'] = 'fieldx': DONT NEED pdo exec/bind
			 	// $fld_param_fld_ary = array_combine($aryParams, $aryFlds);

				 // INSERT INTO table (key, key) VALUES ('value', 'value') use PDO
				 $sql = "INSERT INTO " . static::$table ." (";
				 // $sql .= 'username', 'password', 'first_name', 'last_name';
				 $sql .= $strFldNames;
				 $sql .= ") VALUES (";
				 // $sql .= ":username, :password, :first_name, :last_name" . ")";
				 $sql .= $strParams . ")";

// $sth->execute(array(':calories' => $calories, ':colour' => $colour));
				 if (self::query($sql, array_combine(array_values($aryParams), array_values($dbTblFlds)))) {
				 	self::$column['id'] = self::$_pdo->lastInsertId();
				 	return true;
				 }
			}
			return false; // most likely did not validate check errors
		}  // end public create()

	// *****************end CREATE

  public function get($where) {
  	return $this->action('SELECT *', $where);
  }

// ?*? untested 9/22/18
	public function getFieldsStr($fieldsStr, $where) {
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
  	return self::$_results;
  }

	public function first() {
		return self::$_results()[0];
	}

  public function error() {
  	return self::$_error;
  }

  public function count() {
  	return self::$_count;
  }

	public function disconnect() {
		self::$_dbo = null;
	}
}
