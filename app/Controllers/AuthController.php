<?php

namespace app\Controllers;
use app\Models\User as User;
//Create a named route in app/Routes/Users.php
// $app->get('/hello/:arg1', function ($name) use ($app) {  echo "Hello $name";})->name('hello'); // ?arg1=
// /users and other named urls use url with urlFor()
class AuthController extends Controller {
  // protected static $container;

  public function getSignup($request, $response) {
    $user = User::getInstance();

    if(!$user->count()) {
      // $user->first()->username;
    }
    // ***10/27 pass in nameAry 'user' to signup and use in initialize($nameAryVar)
    $userForm = VIEWS_PATH . DS . 'auth' . DS . 'signup.php';
    $formVars = [ 'userformvars' => '',];
    $formContent = static::$container->view->renderWithVariables($userForm, $formVars, false);
/* rightCol handled by parent(Controller.php)
    $rightColDoc = TEMPLATE_PATH . DS . 'partials' . DS . 'rightCol.php';
    $rightColVars = [ 'rightColVars' => '',
                      'userInfoRight' => 'right side info passed in for user',
                    ];
    $rightCol = $this->container->view->renderWithVariables($rightColDoc, $rightColVars, false);
*/
    // give vals to main.php template vars
		static::$templateVars['content'] = $formContent;

		// set() ONLY works on public_header vars -- all fixed vals set in main.php
    // $this->container->view->set('content', "This is a test of templating using search replace.");
		static::$container->view->set('page_title', "Authenticate");
		$maintemplate = TEMPLATE_PATH . DS . 'main.php';
		static::$container->view->renderWithVariables($maintemplate, static::$templateVars); // , $optiondefltprint=true
  }

  public function postSignup($request, $response){
    global $session;
    // ??????10/21/18 params????????? pass to __construct or getInstance()
    /*  id, privilege_id,username,email,fname,lname, password,
    confirm_password, created_at, updated_at,    */
    $allPostVars = $request->getParsedBody();

    $user = User::getInstance($allPostVars);

    if (!empty($user->errors)){
      // keep current vals in form

      // set session message to errors (?if NOT already done in validate)
      $session->errMsg($user->errors);

      // redirect back to for
      return $response->withRedirect($this->router->pathFor('user.create'));
    }
    // determine and capture errors: e.g. email is_blank, has_presence, has_length
    if ($user->create(array_keys($allPostVars))) {
      echo "Ready to create user " . $user->fullname;
    } else {


    }

      // to home w/built-in router func
      return $response->withRedirect($this->router->pathFor('home'));
  }
}
