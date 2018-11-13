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
		// returns false or $resultAry[]
		global $db;
		self::$_error = false;
		if (is_null(static::$_pdo)) static::set_PDO($db); // insure $db connect

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
						'error' => self::$_error,
						];
  }

  public function action($action, $where = array()) {
		// returns false or $resultAry[]
  	if(count($where) == 3) {
			$operators = array('=', '>', '<', '>=', '<=');
	  	$field = $where[0];
	  	$operator = $where[1];
	  	$value = $where[2];  // TODO: turn val into param assoc array: $where[2][$key]

	  	if(in_array($operator, $operators)) {
	  		$sql = "{$action} FROM {static::table} WHERE {$field} {$operator} :{$field}";

				$resultAry = $query($sql, array($value));

				return $resultAry;
  		}
		} // end if(count($where) == 3)
  	return false;
  }

	private static function uniqFldVals() {
		/* called by create and edit methods to make sure uniqeFlds are unique
			return true if unique
			return false if one or more vals already exists (record errors)
			*/
		$resultArys = [];
		$where = "";
		$uniqResults = true;
		foreach (static::$uniqueFlds as $field) {
			$where = "{$field} = '" . static::$columns[$field] . "'";
			$sql = "SELECT * FROM " . static::$table . " WHERE " . $where;

			$resultAry = self::query($sql);
			// if error -- bad sql
			if (!$resultAry['error']) {
				if ($resultAry['count'] > 0) {
					self::$errors[] = $field . " already exists in DB";
					$uniqResults = false;
				}
			} else {  // error running sql
				self::$errors[] = "DB error in test for unique: " . $field;
				$uniqResults = false; // database error - return false anyway
			}
			// DON'T really need this: $resultArys[] = $resultAry;
		}
		return $uniqResults;
	}

	protected static function validate() {
    // $this->errors = [];  // don't want to zero out the errors array
    // use custom validations in child models befor calling this/parent
		self::uniqFldVals();

    // return $this->errors;  // test for errors elsewhere
  }

	public function create($formVals) {
		 	if ($this->validate()){
				/* remove specific arrays of keys without modifying original array
					function ary_except($ary, $keys) {return ary_diff_key($array, ary_flip((array) $keys));}  */
				// remove cols not created (id) or in db (pw) (flip simp ary vals into keys)
				$dbTblFlds = array_diff_key(static::$columns, array_flip(static::$notInDBCols), array_flip(array("id")));
				$strFldNames = implode(", ", array_keys($dbTblFlds)); // turn keys into comma sep str
			 	$aryParams = $dbTblFlds;  // set up param names for binding in dbStatement exec
			 	foreach ($aryParams as $key => &$value) { $value = ':'. $key;	}

			 	unset($value); // clear for future use
			 	$strParams = implode(", ", $aryParams); // turn params into comma sep str


				 $sql = "INSERT INTO " . static::$table ." (";  // INS. INTO tbl(key, key2) VALUES('val1', 'val2')
				 $sql .= $strFldNames; // $sql .= 'usrname', 'hash_pw', 'fname', 'lname';
				 $sql .= ") VALUES (";
				 $sql .= $strParams . ")"; // $sql .= ":usrname, :hash_pw, :fname, :lname" . ")";

// $sth->execute(array(':calories' => $calories, ':colour' => $colour));
				 if (self::query($sql, array_combine(array_values($aryParams), array_values($dbTblFlds)))) {
				 	static::$column['id'] = self::$_pdo->lastInsertId();
				 	return true;
				 }
			}  // end  if($this->validate()){
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
