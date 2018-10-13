<?php

namespace app\Controllers;
//Create a named route in app/Routes/Auth.php
// $app->get('/hello/:arg1', function ($name) use ($app) {  echo "Hello $name";})->name('hello'); // ?arg1=
// /users and other named urls use url with urlFor()
class AuthController extends Controller {
	protected $view;  // declare for use in constructor

public function create($request, $response) {
  // $this->container->view->set('content', "This is a test of templating using search replace.");

  $templateVars = [
    'cartExists' => 'The cart exists var',
    'routeHasProfile' => 'Route has profile var',
    'container' => $this->container,
    'pageUrls' => [
          'products' => $this->container->get('router')->pathFor('products'),
          'curURL' => $request->getUri()->getPath(),
        ],
    'content' => 'Index Content',
  ];

  // public_header var -- fixed vals set in main.php
  $this->container->view->set('page_title', "Index");

  $maintemplate = TEMPLATE_PATH . DS . 'main.php';
  $this->container->view->renderWithVariables($maintemplate, $templateVars); // , $optiondefltprint=true
  // old method: include VIEWS_PATH . DS . 'main.php';

}
