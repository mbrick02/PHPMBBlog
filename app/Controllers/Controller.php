<?php
/* ***NOTE all post route controllers must do token check:
if(Token::check($_POST['token'])) {echo 'Process order';} */
// ALSO: load ALL controllers into bootstrap/app.php:container (array)
namespace App\Controllers;
use app\Models\User as User;

class Controller {
	protected static $container; // set in bootstrap/app.php w/view as template class

	static $rightColDoc;
	static $rightColVars = [ 'rightColVars' => '',
										'userInfoRight' => 'right side info passed in for user', ];
	static $rightCol;

	// give vals to main.php template vars
	static $templateVars;

	static $publicHeader = "";

// pass in entire $container make available to 'child'/extended controllers
  public function __construct($container, $args = []) { // defaults set here options in initialize
		static::$container = $container; // container defined in bootstrap/app.php
   }

	 protected static function buildLoginForm() {
		 global $db;
		 // $linkCreatUser = "<a href=\"/user/create\" ></a>" . "<div class=\"dropdown-divider\"></div>";
		 $loginForm = VIEWS_PATH . DS . 'auth' . DS . 'login.php';
		 $user = User::getInstance($db); // note: base on db but NOT from -- poss. added user
		 $formVars = [ 'user' => $user];
		 $loginFormContent = static::$container->view->
		 	renderWithVariables($loginForm, $formVars, false);

			return $loginFormContent;
	 }

	 protected static function userOptions($loggedIn) {
	 	// set user menu content based on whether logged in or not
		$userOptions = [];
		if ($loggedIn) {
			$userOptions = [
				'userButton' => 'Edit Profile or <a href="/user/logout">Logout</a>',
				'loginOrProfile' => 'Edit Prifile or logout',
			];
		} else {
			$userButton = '<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"';
			$userButton .= ' data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Login</button>';
			$userButton .= ' or <a href="/user/create">Create User</a>';
			$userOptions = [
				'userButton' => $userButton,
				'loginOrProfile' => static::buildLoginForm(),
			];
		}

		return $userOptions;
	 }

	 protected static function buildPage($contrVars) {
		global $session;
		$lgdIn = $session->is_logged_in();
		$userOptions = static::userOptions($lgdIn); // base user button and form on logged in

		static::$rightColDoc = TEMPLATE_PATH . DS . 'partials' . DS . 'rightCol.php';
		// Note: $container->view is set to template.class.php
		static::$rightCol = static::$container->view->renderWithVariables(static::$rightColDoc, static::$rightColVars, false);

		static::$container->view->filename = 'partials' . DS . 'public_header.php';

		static::$container->view->set('page_title', 'blog'); // default
		if (isset($contrVars['page_title'])) {
			static::$container->view->set('page_title', $contrVars['page_title']);
		}
		static::$container->view->set('urlForIndex', "/");
		static::$container->view->set('urlForMBBlogLogo', IMG_SRC . "mbBlogLogo.jpg");
		// TODO: show backslash before stylesheets 10/29/18
		static::$container->view->set('stylesheet', getBaseUrl() . 'stylesheets/public.css');

		$msgHeader = "";
		if ($session->exists('message')){
			$msgHeader .= $session->display_session_message();
		} elseif ($session->exists('errors')){
			$msgHeader .= $session->display_errors($session->errMsg());
		}
		static::$container->view->set('msgHeader',  $msgHeader);

		static::$publicHeader = static::$container->view->returnText();

		// update cartExists to $cartContent = $session->exists('cart') ? 'Shows a cart' : 'No Cart'

		static::$templateVars = [ // set default vars
			'cartExists' => $session->exists('cart') ? $session->get('cart')['totalQty'] : 'No Cart',
			'userButton' => $userOptions['userButton'],
			'loginOrProfile' => $userOptions['loginOrProfile'],
			'container' => static::$container,
			'publicHeader' => static::$publicHeader,
			'pageUrls' => [ 'products' => static::$container->get('router')->pathFor('products'),
						'curURL' => static::$container->request->getUri()->getPath(),
					],
			'content' => "",  // set by child
			'rightCol' => static::$rightCol,
		];
		if (!empty($contrVars)) {
			static::$templateVars = array_replace(static::$templateVars, $contrVars);
		}

// In Laravel set:
//	{{ Request::is(Route::has('profile')) ? "active" : "" }}" href="/profile/{{ Auth::user()->id }}

		$maintemplate = TEMPLATE_PATH . DS . 'main.php';
		static::$container->view->renderWithVariables($maintemplate, static::$templateVars);
						// , $optiondefltprint=true
	}

/* using __get() in this way does not seem to work in php 7.1.22 */
  public function __get($property) {  // can be used to create shortcut calls to property values
	    // ***WARNING if overused, can be confusing
			if (static::$container->{$property}) {
	        return static::$container->{$property};
					// if prop in container, get w/out specifying container
					// e.g HomeConroller->view instead HomeController->container->view
        }
  }
}
