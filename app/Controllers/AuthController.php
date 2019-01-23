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
    /*  $allPostVars returns: 'login' =>  array (size=3)
    'token' => string '4cc29d3db4823b7cd8c07d0a55dd12b9' (length=32)
    'usernameOREmail' => string 'x' (length=1)
    'password' => string 'y' (length=1) */
    $unameOREmail = isset($allPostVars['login']['usernameOREmail'])? $allPostVars['login']['usernameOREmail'] : '';
    $pw = isset($allPostVars['login']['password'])? $allPostVars['login']['password'] : '';

    // determine if username or Email
    // ??validEmail($unameOREmail);
    if (!empty($unameOREmail)) { // 1st test not empty
      if (has_valid_email_format($unameOREmail)) {
        // lookup Email
        echo "Lookup email in AuthController:login - need to lookup email User:verifyEmail";
        die;
      } else { // not an email so look for user
        $validUser = User::verifyUser($unameOREmail, $pw);

        if ($validUser) {
          // user logged in: $session->getMsg("Logged in: " . $userInstance->fullname);
          // ?sessionLogin??
          // **1/22/19 Do all Session functions in AuthController:login
          // 1/22/19 5P Left off here **********************
          $session::login($validUser);
          $session::message("Logged in: " . $validUser->username);

          } else {
              $session->errMsg(array("Bad username and/or password"));
          }
        }  // end if ($validUser)
    } else {
      $session->errMsg(array("Please enter username or email and password"));
    } // end if(!empty($unameOREmail)) - else
    return $response->withRedirect($this->router->pathFor('home'));  // return to home???? or previous w/Vals?
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
