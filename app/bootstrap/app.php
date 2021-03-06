<?php

// Slim framework
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

// without error handling: $app = new \Slim\App;

// **DELEE FOR PRODUCTION** with error handling:
$app = new \Slim\App([
  'settings' => [
    'displayErrorDetails' => true,
  ]
]);

$container = $app->getContainer(); // use to bind (hook in) controllers etc.

$container['view'] = function($container) {
  /*  If Twig implemented
  $view = new \Slim\Views\Twig(__DIR__ . '/../resources/views', [
  		'cache' = false,  // turn it off now -- in production might set to directory for cache
  ]);
  $view->addExtension(new \Slim\Views\TwigExtension(
  	$container->router,  // need router to generate URLs & links to view
  	$container->request->getUri()  // bring in current URI
  ));
  return $view;
  **** end - If Twig implemented */

  $view = new Template;  // Skoglund PHP MySQL Beyond Basics course
  /* usage:  $template = new Template();
  $template->filename = "template2.php";
  $template->set('pageTitle', "Template Test"); $template->set('content', "search replace templ");
  $template->display();
  */

  return $view;
}; // *** end container['view'] = function (){}


$controllers = array("HomeController", "AuthController", "ProductController", "TaskController");
$appController = "";

foreach ($controllers as $controller) {
    $container[$controller] = function ($container) use ($controller, $appController) {
      // pass in $container to use in controller
      $appController = "app\\Controllers\\" . $controller;
    	return new $appController($container);
    };
}
// DEBUG**: end $controllers array for  controller names
/* making below programatic above on array of controller names
// $container['HomeController'] = function ($container) {
  // pass in $container to use in controller
//  return new app\Controllers\HomeController($container);
// };  *** end DEBUG** $container of controller */


// db
$container['db'] = function () {
  global $db;
	// ** old ver (See Slim Framework
  // ** return new PDO('mysql;host=localhost;dbname=', 'root', 'root');
  // return DB::getInstance();  // working with global $db from initialize.php
  return $db;
};


require_once('../app/routes.php');
