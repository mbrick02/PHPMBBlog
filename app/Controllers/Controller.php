<?php
/* ***NOTE all post route controllers must do token check:
if(Token::check($_POST['token'])) {echo 'Process order';} */
// ALSO: load ALL controllers into bootstrap/app.php:container (array)
namespace App\Controllers;

class Controller {
	protected static $container;

	static $rightColDoc;
	static $rightColVars = [ 'rightColVars' => '',
										'userInfoRight' => 'right side info passed in for user', ];
	static $rightCol;

	// give vals to main.php template vars
	static $templateVars;

// pass in entire $container make available to 'child'/extended controllers
  public function __construct($container) {
		static::$container = $container; // container defined in bootstrap/app.php
		static::$rightColDoc = TEMPLATE_PATH . DS . 'partials' . DS . 'rightCol.php';
		static::$rightCol = static::$container->view->renderWithVariables(static::$rightColDoc, static::$rightColVars, false);
		global $session;

		static::$templateVars = [
			'cartExists' => $session->exists('cart') ? 'Shows a cart' : 'No Cart',
			'routeHasProfile' => 'Route has profile var',
			'container' => static::$container,
			'pageUrls' => [
						'products' => static::$container->get('router')->pathFor('products'),
						'curURL' => static::$container->request->getUri()->getPath(),
					],
			'content' => "",  // set by child
			'rightCol' => static::$rightCol,
		];
   }

/* using __get() in this way does not seem to work in php 7.1.22 */
  public function __get($property) {  // can be used to create shortcut calls to property values
	    // ***WARNING if overused, these shortcuts can be confusing
			// ** DEBUG: var_dump($property);
			if (static::$container->{$property}) {
	        return static::$container->{$property};
					// if prop in container, get w/out specifying container
					// e.g HomeConroller->view instead HomeController->container->view
        }
  }
/*  Not using because __set can't be easily used like __get()
	public function __set($property, $value) {  // CANT make shortcut req of prop vals
			echo "What is this property";
			if ($this->container->{$property}) {
	        // $this->container->{$property} = $value;
					// if prop in container, set w/out spec. container
					// e.g HomeConroller->view= $val instead HomeController->container->view = $val
        }
  }
****	  */
/* 10/29/18  this out to simplify
	public function sessionExists($sessionAttrib) {
		global $session;
		if ($session->exists($sessionAttrib)){
			return true;
		} else { return false; }
	}
*/

}
