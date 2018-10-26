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
    //Single POST parameter: $postParam = $allPostVars['postParam'];
    // DEBUG** 10/26/18 test $_POST['admin']: var_dump($allPostVars);
    // DEBUG** 10/22/18: echo "<br /> <h2>AuthController:postSignup SallPostVars</h2><hr /><br />";
    // DEBUG** 10/22/18: die();

    $user = User::getInstance($allPostVars);
    // ::query("SELECT * FROM users");
      // ['results' => self::$_results, 'count' => self::$_count,]; OR false
    var_dump($user);
    die();
    // determine and capture errors: e.g. email is_blank, has_presence, has_length
    if ($user->create(array_keys($allPostVars))) {
      echo "Ready to create user " . $user->fullname;
    } else {
      $session->message($session->display_errors($user->errors));
      // DEBUG** 10/22/18: var_dump($user->errors);
      // DEBUG** 10/22/18: echo "<br /> <h2>AuthController:postSignup !user-create</h2><hr /><br />";
      // DEBUG** 10/22/18: var_dump($user);
      // DEBUG** 10/22/18: die();
      return $response->withRedirect($this->router->pathFor('user.create'));
    }



      // to home w/built-in router func
      return $response->withRedirect($this->router->pathFor('home'));
  }
}
