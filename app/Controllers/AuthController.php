<?php

namespace app\Controllers;
use app\Models\User as User;
//Create a named route in app/Routes/Users.php
// $app->get('/hello/:arg1', function ($name) use ($app) {  echo "Hello $name";})->name('hello'); // ?arg1=
// /users and other named urls use url with urlFor()
class AuthController extends Controller {

  public function create($request, $response) {
    $user = User::getInstance("users");

    if(!$user->count()) {
      // $user->first()->username;
    }
    $userForm = VIEWS_PATH . DS . 'auth' . DS . 'signup.php';

    $formVars = [
      'userformvars' => '',
    ];
    $formContent = $this->container->view->renderWithVariables($userForm, $formVars, false);

    // give vals to main.php template vars
		$templateVars = [
			'cartExists' => 'The cart exists var',
			'routeHasProfile' => 'Route has profile var',
			'container' => $this->container,
			'pageUrls' => [
						'products' => $this->container->get('router')->pathFor('products'),
						'curURL' => $request->getUri()->getPath(),
					],
			'content' => $formContent,
		];

		// set() ONLY works on public_header vars -- all fixed vals set in main.php
    // $this->container->view->set('content', "This is a test of templating using search replace.");
		$this->container->view->set('page_title', "Authenticate");

		$maintemplate = TEMPLATE_PATH . DS . 'main.php';
		$this->container->view->renderWithVariables($maintemplate, $templateVars); // , $optiondefltprint=true
  }
}
