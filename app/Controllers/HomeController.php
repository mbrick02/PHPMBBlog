<?php
namespace app\Controllers;
// If we use Twig Views: use Slim\Views\Twig as View;
//Gen named route URL: $url = $app->urlFor('products', array('arg1' => 'value')); // ?arg1=

class HomeController extends Controller {
	// protected $view;  // declare for use in constructor
/*  **** MOVED this to base class Constructor to simplify:
public function __construct(View $view)  // was just view -- now whole container
{	$this->view = $view;}****** */

	public function index($request, $response) {
		// IF USING TWIG:
    // return $this->container->view->render($response, 'home.twig');
    // return $this->view->render($response, 'home.twig');

		// Old ver pre 12/1/18: static::$container->view->set('content', "This is a test of templating using search replace.");
		// $htmlSections = [	'doubtUse' =>"Doubt this will be useful",];
		global $session;
		$lgdIn = $session->is_logged_in();
		$userOptions = static::userOptions($lgdIn); // base user button and form on logged in

		static::$rightColDoc = TEMPLATE_PATH . DS . 'partials' . DS . 'rightCol.php';
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

		// ****Above up to // 12/1/18 note added because $pbulicHeader undefined

		$templateVars = [
			'cartExists' => 'The cart exists HomeController var',
			'routeHasProfile' => 'Route has profile var',
			'container' => static::$container,
			'pageUrls' => [
						'products' => static::$container->get('router')->pathFor('products'),
						'curURL' => $request->getUri()->getPath(),
					],
			'publicHeader' => static::$container->view->returnText(),
			'content' => 'Index Content',
		];

		// public_header var -- fixed vals set in main.php
		static::$container->view->set('page_title', "Index");

		$maintemplate = TEMPLATE_PATH . DS . 'main.php';
		static::$container->view->renderWithVariables($maintemplate, $templateVars); // , $optiondefltprint=true
		// old NON-render global method: include VIEWS_PATH . DS . 'main.php';
  }
}
