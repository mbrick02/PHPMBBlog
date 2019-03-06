<?php
namespace app\Controllers;
use app\Models\User as User;
// If we use Twig Views: use Slim\Views\Twig as View;
//Gen named route URL: $url = $app->urlFor('products', array('arg1' => 'value')); // ?arg1=

class HomeController extends Controller {
	// protected static $container;
  protected static function buildPage($contrVars = []) { // unused as of 11/14/18
    $contrVars = array_replace($contrVars, ['page_title' => 'Home',]);
    parent::buildPage($contrVars);
  }

	public function index($request, $response) {
		// IF USING TWIG: return static::$container->view->render($response, 'home.twig');

		global $db; // needed for DB/Model class instances

		$user = User::getInstance($db); // ***if user is logged-in NEED to get from sess

		$homeP = VIEWS_PATH . DS . 'templates' . DS . 'partials' . DS . 'home.php';

		$formVars = [ 'user' => $user];  // originally of signup, but ?use logged-in sess $user for profile

    $homePanel = static::$container->view->renderWithVariables($homeP, $formVars, false);

    // give vals to main.php template vars
		$optionvars = [];

		$optionvars['content'] = $homePanel;

		static::buildPage($optionvars);
  }

  public function testMB($param1='') { // route: /testMB
    $testPageFile = TEMPLATE_PATH . DS . 'testMBCodePage.html';
    $formVars = [];
    $testPage = static::$container->view->
     renderWithVariables($testPageFile, $formVars, false);

     return $testPage;
  }

  public function testPHP($param1='') { // route: /testMBPHP
    $testPageFile = TEMPLATE_PATH . DS . 'testMBPHPPage.php';
    $formVars = [];
    $testPage = static::$container->view->
     renderWithVariables($testPageFile, $formVars, false);

     return $testPage;
  }

  public function createTask($param1='') { // route: /testMBPHP
    $testPageFile = TEMPLATE_PATH . DS . 'testCreateTask.php';
    $formVars = [];
    $testPage = static::$container->view->
     renderWithVariables($testPageFile, $formVars, false);

     return $testPage;
  }
}
