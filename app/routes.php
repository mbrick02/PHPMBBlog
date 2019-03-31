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

// ** used in SpeedCoding course 3/19
$app->get('/indexTask', 'TaskController:index'); // **MOVE to Routs/Tasks.php
$app->get('/testMB', 'HomeController:testMB');
$app->get('/testMBPHP', 'HomeController:testPHP');
$app->get('/create_task', 'HomeController:createTask');
$app->get('/create_task/{id}', 'HomeController:createTask');
$app->get('/indexSCATask', 'HomeController:indexTask');
$app->get('/submit_task', 'HomeController:submitTask');  // Should NOT happen
$app->get('/create_member', 'HomeController:createMember');
$app->get('/create_member/{id}', 'HomeController:createMember');
$app->get('/members', 'HomeController:members');
$app->get('/membvwcreate', 'HomeController:membvwcreate');
$app->get('/membvwmanage', 'HomeController:membvwmanage');
$app->post('/submit_member', 'HomeController:submit_member');

/* ***NOTE all post route controllers must do token check:
if(Token::check($_POST['token'])) {
  echo 'Process order';
}
*/

require_once('Routes/Products.php');
require_once('Routes/Users.php');
