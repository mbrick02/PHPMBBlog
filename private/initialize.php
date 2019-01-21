<?php
  ob_start(); // turn on output buffering so build whole page and 'modify' header
//  session_start(); // implemented session.class instead // turn on sessions if needed
  use app\Models\PDOConn as PDOConn;
  use app\Models\DB as DB;

  // Assign PHP constant file paths: __FILE__ returns cur path, dirname() path parent dir
  define("DS", DIRECTORY_SEPARATOR);
  define("PRIVATE_PATH", dirname(__FILE__));
  define("PROJECT_PATH", dirname(PRIVATE_PATH));
  define("PUBLIC_PATH", PROJECT_PATH . DS . 'public');
  define("APP_PATH", PROJECT_PATH . DS . 'app');
  define("SHARED_PATH", PRIVATE_PATH . DS . 'shared');
  define("VIEWS_PATH", PRIVATE_PATH . DS . 'resources' . DS . 'views');
  define("TEMPLATE_PATH", PRIVATE_PATH . DS . 'resources' . DS . 'views' . DS . 'templates');
  define("PARTIALS_PATH", PRIVATE_PATH . DS . 'resources' . DS . 'views' . DS . 'templates' . DS . 'partials');
  define("CONTROLLERS_PATH", APP_PATH . DS . 'controllers');
  define("ROUTES_PATH", APP_PATH . DS . 'routes');
  $servPort =(($_SERVER['SERVER_PORT'] != '80') ? ':' . $_SERVER['SERVER_PORT'] : '') ;
  $servPrefix = isset($_SERVER['HTTPS']) ? 'https://' : 'http://'; // php 7 $_SERVER['HTTPS'] ?? 'http://';
  define("IMG_SRC", $servPrefix . $_SERVER['SERVER_NAME'] . $servPort . '/images/');

  // Assign the root URL to a PHP constant
  // * Do not need to include the domain
  // * Use same document root as webserver
  // * Can set a hardcoded value: ($_SERVER['SCRIPT_NAME'] of index.php)
  // define("WWW_ROOT", '/**PATH_TO_WEB_ROOT/chain_gang/public');
  // define("WWW_ROOT", '');
  // * Can dynamically find everything in URL up to "/public"
/* *** WON'T WORK from Skoglund course that had /public directory as home
  $public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
  $doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
  define("WWW_ROOT", $doc_root);   // don't need WWW_ROOT - just give dir
** above WON'T WORK - routing URLs thru /public/index.php so just '/dirname' */

  require_once('functions.php');
  // Moved to private/classes/session.class.php: require_once('status_error_functions.php');
  require_once('db_credentials.php');
  require_once('database_functions.php');
  require_once('validation_functions.php');

  // combining Skoglund PHP OOP and add this from PHP Tools - OOP Login/Reg YouTube
  $GLOBALS['config'] = array(
  	'mysql' => array(
  	'host' => '127.0.0.1',
  	'username' => 'michael',
  	'password' => 'Job4Fau',
  	'db' => 'mbblog'
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
/*  foreach(glob('classes/' . '*.class.php') as $file) {
      require_once($file);
  } */

  // (Skoglund) Autoload class definitions (?redundant above ???)
  function my_autoload($class) {
    $class_file = PRIVATE_PATH . '/classes/' . strtolower($class) . '.class.php';
    // $controller_file = PRIVATE_PATH . '/controllers/' . strtolower($class) . '.class.php';
    if(preg_match('/\A\w+\Z/', $class)) {
      if(is_file($class_file)) {
          // include('classes/' . $class . '.class.php');
          require_once('classes/' . strtolower($class) . '.class.php');
        // had to use strtolower -- somehow linux (only) would cap Session
      }
    }
  }

  spl_autoload_register('my_autoload'); // spl = standard php library
  // require_once('classes/session.class.php'); // ***DEBUG DIDNT WORK:
  // DELETED 10/29/18 ABOVE LINE AND MOVED BELOW after AUTOLOAD
  $session = new Session;
  // $_SESSION['message'] = 'test102918';
  // echo "Session[message]: " . $_SESSION['message'];
  // die();

  require_once('../app/bootstrap/app.php');

// *** PHP Tools - Codecourse OOP Login/Register YouTube autoload:
//      spl_autoload_register(function($class) {	require_once 'classes/' . $class . '.php'; });
// pdo('mysql:host=' . Config::get('mysql/host') . '; dbnm=' . Config::get('mysql/name'));
  // container in app.php will reference this as a global:

  $db = new PDOConn;  // Note: controller access to (global) db is now through container
  DB::set_PDO($db);
?>
