<?php

namespace app\Controllers;

// If we use Twig Views: use Slim\Views\Twig as View;

class HomeController extends Controller {
	protected $view;  // declare for use in constructor

/*  **** MOVE this to base class Constructor to simplify:
public function __construct(View $view)  // was just passing in view -- now pass in container
{
	$this->view = $view;
}
****** */

	public function index($request, $response) {
		// IF USING TWIG:
    // return $this->container->view->render($response, 'home.twig');
    // return $this->view->render($response, 'home.twig');


		$this->container->view->set('content', "This is a test of templating using search replace.");
		// echo "<h1>This is a test page</h1>";
		$pageUrls = [
					'products' => $this->container->get('router')->pathFor('products'),
					'curURL' => $request->getUri()->getPath(), // current URL
					// 'logout' => $this->container->get('router')->pathFor('logout'),
					// 'login' => $this->container->get('router')->pathFor('login'),
					// 'signin' =>$this->container->get('router')->pathFor('signin'),
				];

		$htmlSections = [
					'content' =>"<p>Test of search/repl template.</p>",
				];

		// 10/6 for products and other urls use/setup named url from urlFor()
		// //Create a named route
// $app->get('/hello/:arg1', function ($name) use ($app) {  echo "Hello $name";})->name('hello');

//Generate a URL for the named route: $url = $app->urlFor('products', array('arg1' => 'value'));


		include VIEWS_PATH . DS . 'main.php';

  }
}
