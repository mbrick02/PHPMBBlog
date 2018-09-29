<?php

// Slim framework
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

$app = new \Slim\App;

$app = new \Slim\App([
  'settings' => [
    'displayErrorDetails' => true,
  ]
]);

$container = $app->getContainer(); // use to bind (hook in) controllers etc.

$container['view'] = function($container) {  // ***DEBUG also return $vie
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
  /* usage:
  $template = new Template();
  $template->filename = "template2.php";
  $template->set('pageTitle', "Template Test");
  $template->set('content', "This is a test of templating using search replace.");
  $template->display();
  */

  return $view;
};

$container['HomeController'] = function ($container) {  // pass in $container for future use
	return new app\controllers\HomeController($container);
 };

require_once('../app/routes.php');
