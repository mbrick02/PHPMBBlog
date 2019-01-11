<?php
use App\Controllers;
// ***APPARENTLY YOU CAN ONLY AUTOLOAD CLASSES
// see my_autoload in intialize.php
/* function route_autoload($route) {
  if(preg_match('/\A\w+\Z/', $route)) {require_once('routes/' . strtolower($route) . '.php');
  } // had to use strtolower -- some reason linux (only) would cap (?class) Session
}
spl_autoload_register('route_autoload'); */
//Create a named route: (->name() or setName()?)
// $app->get('/hello/:arg1', function ($name) use ($app) {  echo "Hello $name";})->name('hello');
$app->get('/', 'HomeController:index')->setName('home');

$app->get('/testMB', 'HomeController:testMB');
$app->get('/testMBPHP', 'HomeController:testPHP');

/* ***NOTE all post route controllers must do token check:
if(Token::check($_POST['token'])) {
  echo 'Process order';
}
*/

require_once('Routes/Products.php');
require_once('Routes/Users.php');
