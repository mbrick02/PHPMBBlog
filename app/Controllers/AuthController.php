<?php

namespace app\Controllers;
use app\Models\User as User;
//Create a named route in app/Routes/Users.php
// $app->get('/hello/:arg1', function ($name) use ($app) {  echo "Hello $name";})->name('hello'); // ?arg1=
// /users and other named urls use url with urlFor()
class AuthController extends Controller {
  // protected static $container;
  protected static function buildPage($contrVars = []) { // unused as of 11/14/18
    $contrVars = array_replace($contrVars, ['page_title' => 'Authenticate',]);
    parent::buildPage($contrVars);
  }

  public function getSignup($request, $response) {
    global $db;
    $user = User::getInstance($db);

    // exclude values from form restore on error or NOT validated
    $excludeAry = array("password", "confirm_password");
    $user->restoreFormValsSessCols($excludeAry);  // retrieve form values from session reset

    $userForm = VIEWS_PATH . DS . 'auth' . DS . 'signup.php';
    $formVars = [ 'user' => $user];
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
    /*  id, privilege_id,username,email,fname,lname, password,
    confirm_password, created_at, updated_at,    */
    $allPostVars = $request->getParsedBody();
    $user = User::getInstance($db, $allPostVars);

    // $user->validate(); // called in DB->create
    // determine and capture errors: e.g. email is_blank, has_presence, has_length
    if ($user->create(array_keys($allPostVars))) {
      $session->getMsg("User created for " . $user->fullname);
    } else { // create failed probably validation error OR some DB error
      $user->putFormValsSess();  // store form values in session to resubmit
      if ($user->error()){ // validation errors display via session
        $session->errMsg($user->errors);
      } else {
        $session->errMsg("Non-validation (possible DB) error with Create form");
      }
      return $response->withRedirect($this->router->pathFor('user.create')); // redirect back to form
    }
    // redirect to home w/built-in router func
    return $response->withRedirect($this->router->pathFor('home'));
  }

  public function login($request, $response){
    global $session;
    global $db;

    $allPostVars = $request->getParsedBody(); // login vars NOT user as in signup
    $user = User::getInstance($db, $allPostVars); // usernameEmail (not username or email) pw
    // username or email, look for user, if user then, password_verify($pw, $dbhash)
    //  do email verify 1st, but even if verified email...
    //    if email not found, still test username

  }

  public function getEditUser($request, $response) {
    global $db;
    $user = User::getInstance($db);

    // exclude values from form restore on error or NOT validated
    $excludeAry = array("password", "confirm_password"); // Note only show confirm_password if pw to change
    $user->restoreFormValsSessCols($excludeAry);  // retrieve form values from session reset

    $userForm = VIEWS_PATH . DS . 'auth' . DS . 'editUser.php';
    $formVars = [ 'user' => $user];
    $formContent = static::$container->view->
      renderWithVariables($userForm, $formVars, false);

    // give vals to main.php template vars
    $optionvars = [];
		$optionvars['content'] = $formContent;
    $optionvars['page_title'] = "Edit User";

		parent::buildPage($optionvars);
  }
}
