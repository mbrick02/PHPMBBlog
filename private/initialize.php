<?php

  ob_start(); // turn on output buffering so build whole page and 'modify' header

  session_start(); // turn on sessions if needed

  // Assign file paths to PHP constants
  // __FILE__ returns the current path to this file
  // dirname() returns the path to the parent directory
  define("PRIVATE_PATH", dirname(__FILE__));
  define("PROJECT_PATH", dirname(PRIVATE_PATH));
  define("PUBLIC_PATH", PROJECT_PATH . '/public');
  define("SHARED_PATH", PRIVATE_PATH . '/shared');

  // Assign the root URL to a PHP constant
  // * Do not need to include the domain
  // * Use same document root as webserver
  // * Can set a hardcoded value:
  // define("WWW_ROOT", '/**PATH_TO_WEB_ROOT/chain_gang/public');
  // define("WWW_ROOT", '');
  // * Can dynamically find everything in URL up to "/public"
  $public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
  $doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
  define("WWW_ROOT", $doc_root);

  require_once('functions.php');
  require_once('status_error_functions.php');
  require_once('db_credentials.php');
  require_once('database_functions.php');
  require_once('validation_functions.php');

  // combining Skoglund PHP OOP and add this from PHP Tools - OOP Login/Reg YouTube
  $GLOBALS['config'] = array(
  	'mysql' => array(
  	'host' => '127.0.0.1',
  	'username' => 'michael',
  	'password' => '',
  	'db' => 'lr'
    ),
    'remember' => array(
    	'cookie_name' => 'hash',
    	'cookie_expiry' => 604800
    ),
    'session' => array(
    	'session_name' => 'user',
    	'token_name' => 'token'
    )
    );


    // Load class definitions manually
    // -> Individually
    // require_once('classes/bicycle.class.php');

    // OR -> All classes in directory
    foreach(glob('classes/' . '*.class.php') as $file) {
      require_once($file);
    }

    // (Skoglund) Autoload class definitions
    function my_autoload($class) {
      if(preg_match('/\A\w+\Z/', $class)) {
        include('classes/' . $class . '.class.php');
      }
    }
    spl_autoload_register('my_autoload'); // spl = standard php library


// *** PHP Tools - Codecourse OOP Login/Register YouTube autoload:
//      spl_autoload_register(function($class) {	require_once 'classes/' . $class . '.php'; });

  // *****NEW DB LINES BELOW ********************************

  // he adds: $database = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
  // ...??
  // $database = db_connect();
  // ?? DatabaseObject::set_database($database);
  // BUT: DB.php pdo class instead (see PHP Tools, PHP OOP Login/Resgister System: DB (p9/23))
  // $db = new DB;
  // which includes:
  // pdo('mysql:host=' . Config::get('mysql/host') . '; dbname=' . Config::get('mysql/name'));


  $session = new Session;
?>
