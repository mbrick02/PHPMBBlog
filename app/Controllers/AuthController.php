<?php

namespace app\Controllers;
use app\Models\User as User;
//Create a named route in app/Routes/Users.php
// $app->get('/hello/:arg1', function ($name) use ($app) {  echo "Hello $name";})->name('hello'); // ?arg1=
// /users and other named urls use url with urlFor()
class AuthController extends Controller {

  public function getSignup($request, $response) {
    $user = User::getInstance("users");

    if(!$user->count()) {
      // $user->first()->username;
    }
    $userForm = VIEWS_PATH . DS . 'auth' . DS . 'signup.php';
    $formVars = [ 'userformvars' => '',];
    $formContent = $this->container->view->renderWithVariables($userForm, $formVars, false);

    $rightColDoc = TEMPLATE_PATH . DS . 'partials' . DS . 'rightCol.php';
    $rightColVars = [ 'rightColVars' => '',
                      'userInfoRight' => 'right side info passed in for user',
                    ];
    $rightCol = $this->container->view->renderWithVariables($rightColDoc, $rightColVars, false);

    // give vals to main.php template vars
		$templateVars = [
			'cartExists' => $this->sessionExists('cart') ? 'Shows a cart' : 'No Cart',
			'routeHasProfile' => 'Route has profile var',
			'container' => $this->container,
			'pageUrls' => [
						'products' => $this->container->get('router')->pathFor('products'),
						'curURL' => $request->getUri()->getPath(),
					],
			'content' => $formContent,
      'rightCol' => $rightCol,
		];

		// set() ONLY works on public_header vars -- all fixed vals set in main.php
    // $this->container->view->set('content', "This is a test of templating using search replace.");
		$this->container->view->set('page_title', "Authenticate");
		$maintemplate = TEMPLATE_PATH . DS . 'main.php';
		$this->container->view->renderWithVariables($maintemplate, $templateVars); // , $optiondefltprint=true
  }

  public function postSignup($request, $response){
    // determine and capture errors: e.g. email is_blank, has_presence, has_length
    $validation = ?validate($request, [
      'email' => v::noWhitespace()->notEmpty(),
      'name' => v::notEmpty(),
      'password' => v::noWhitespace()->notEmpty(),
      ]);

      if ($validation->failed()) {
      return $response->withRedirect($this->router->pathFor('auth.signup'));
      }

      // DEBUG**: var_dump($request->getParams()); // [Submit] ..auth/signup.twig = user form data
      $user = User::create([
        'email'  => $request->getParam('email'),
        'name'  => $request->getParam('name')->alpha(),
        'password'  => password_hash($request->getParam('password'), PASSWORD_DEFAULT),
      ]);

      // to home w/built-in router func
      return $response->withRedirect($this->router->pathFor('home'));
  }
}
