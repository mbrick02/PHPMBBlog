<?php
// '/products' and other urls use named url with urlFor()
//Create a named route: (->name() or setName()?) in Routes/Products.php
// $app->get('/hello/:arg1', function ($name) use ($app) {  echo "Hello $name";})->name('hello');

namespace app\Controllers;
use app\Models\Product as Product;
// If we use Twig Views: use Slim\Views\Twig as View;

class ProductController extends Controller {

	public function index($request, $response) {
		$products = Product::getInstance("products")->getAll();

		$productContent = "";

		if(!$products->count()) {
			$productContent = 'No products';
		} else {
			// controllers/products@show)
			foreach($products->results() as $product) {
				 $productContent .= "<h2>". $product->title . "</h2><br>";
			}
		}
		// $htmlSections = [	'doubtUse' =>"Doubt this will be useful",];
    // give vals to main.php template vars
		$templateVars = [
			'cartExists' => 'The cart exists product var',
			'routeHasProfile' => 'Route has profile var',
			'container' => $this->container,
			'pageUrls' => [
						'products' => $this->container->get('router')->pathFor('products'),
						'curURL' => $request->getUri()->getPath(),
					],
			'content' => $productContent,
		];

		// set() ONLY works on public_header vars -- all fixed vals set in main.php
    // $this->container->view->set('content', "test templating w/search/repl");
		$this->container->view->set('page_title', "Products");

		$maintemplate = TEMPLATE_PATH . DS . 'main.php';
		$this->container->view->renderWithVariables($maintemplate, $templateVars);
          // , $optiondefltprint=true
  }
}
