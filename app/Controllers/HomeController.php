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

		$this->container->view->set('content', "This is a test of templating using search replace.");
		// $htmlSections = [	'doubtUse' =>"Doubt this will be useful",];


		$templateVars = [
			'cartExists' => 'The cart exists HomeController var',
			'routeHasProfile' => 'Route has profile var',
			'container' => $this->container,
			'pageUrls' => [
						'products' => $this->container->get('router')->pathFor('products'),
						'curURL' => $request->getUri()->getPath(),
					],
			'content' => 'Index Content',
		];

		// public_header var -- fixed vals set in main.php
		$this->container->view->set('page_title', "Index");

		$maintemplate = TEMPLATE_PATH . DS . 'main.php';
		$this->container->view->renderWithVariables($maintemplate, $templateVars); // , $optiondefltprint=true
		// old NON-render global method: include VIEWS_PATH . DS . 'main.php';

  }
}
