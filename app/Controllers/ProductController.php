<?php
// '/products' and other urls use named url with urlFor()
//Create a named route: (->name() or setName()?) in Routes/Products.php
// $app->get('/hello/:arg1', function ($name) use ($app) {  echo "Hello $name";})->name('hello');

namespace app\Controllers;
// If we use Twig Views: use Slim\Views\Twig as View;

class HomeController extends Controller {
	protected $view;  // declare for use in constructor

	public function index($request, $response) {

		$this->container->view->set('content', "This is a test of templating using search replace.");
		// $htmlSections = [	'doubtUse' =>"Doubt this will be useful",];

		$templateVars = [
			'cartExists' => 'The cart exists var',
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
		// old method: include VIEWS_PATH . DS . 'main.php';

  }
}
