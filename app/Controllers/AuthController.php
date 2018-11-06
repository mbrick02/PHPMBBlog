<?php

namespace app\Controllers;
use app\Models\User as User;
//Create a named route in app/Routes/Users.php
// $app->get('/hello/:arg1', function ($name) use ($app) {  echo "Hello $name";})->name('hello'); // ?arg1=
// /users and other named urls use url with urlFor()
class AuthController extends Controller {
  // protected static $container;
  protected static function buildPage($contrVars = []) {
    $contrVars = array_replace($contrVars, ['page_title' => 'Authenticate',]);
    parent::buildPage($contrVars);
  }

  public function getSignup($request, $response) {
    global $db;
    $user = User::getInstance($db);

    if(!$user->count()) {
      // $user->first()->username;
    }
    // ***10/27 pass in nameAry 'user' to signup and use in initialize($nameAryVar)
    $excludeAry = array("password", "confirm_password");
    $user->restoreFormValsSessCols($excludeAry);  // retrieve form values from session reset
// DEBUG** 11/2    ***********left off here 10/31 set form vals to go from session back into form
    // echo "In AuthController (26) after restorFormVals... static:cols: ";
    // var_dump($user->getCols());
    // die();

    $userForm = VIEWS_PATH . DS . 'auth' . DS . 'signup.php';
    $formVars = [ 'user' => $user]; // ?? , 'values' => $formValsAry
    $formContent = static::$container->view->
      renderWithVariables($userForm, $formVars, false);

    // give vals to main.php template vars
    $optionvars = [];
		$optionvars['content'] = $formContent;
    $optionvars['page_title'] = "Create User";

		parent::buildPage($optionvars);
  }

  public function postSignup($request, $response){
    global $session;
    global $db;
    // ??????10/21/18 params????????? pass to __construct or getInstance()
    /*  id, privilege_id,username,email,fname,lname, password,
    confirm_password, created_at, updated_at,    */
    $allPostVars = $request->getParsedBody();

    $user = User::getInstance($db, $allPostVars);

    // $user->validate(); // called in DB->create


    // determine and capture errors: e.g. email is_blank, has_presence, has_length
    if ($user->create(array_keys($allPostVars))) {
      echo "Ready to create user " . $user->fullname;
    } else { // create failed probably validation error OR some DB error
      if (!empty($user->errors)){
        // keep current vals in form
        $user->putFormValsSess();

        // set session message to errors (?if NOT already done in validate)
        $session->errMsg($user->errors);
      } else {
        $session->errMsg("Non-validation (possible DB) error with Create form");

        // redirect back to form
        return $response->withRedirect($this->router->pathFor('user.create'));
      }

    }

      // to home w/built-in router func
      return $response->withRedirect($this->router->pathFor('home'));
  }
}
