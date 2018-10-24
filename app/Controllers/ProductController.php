<?php
// '/products' and other urls use named url with urlFor()
//Create a named route: (->name() or setName()?) in Routes/Products.php
// $app->get('/hello/:arg1', function ($name) use ($app) {  echo "Hello $name";})->name('hello');

namespace app\Controllers;
use app\Models\Product as Product;
// use app\Models\DBConnect as DBConnect;
// If we use Twig Views: use Slim\Views\Twig as View;

class ProductController extends Controller {

	public function index($request, $response) {
		$product = Product::getInstance();
		$products = $product->getAll(Product::getTable());
		// var_dump($products);
		// die();

		$productContent = "";

		if(!$products['rowCount']) {
			$productContent = 'No products';
		} else {
			// controllers/products@show)
			foreach($products['records'] as $product) {
				$productContent .= "<h2>". $product->title . "</h2><br>";
			}
		}
		// $htmlSections = [	'doubtUse' =>"Doubt this will be useful",];
    // give vals to main.php template vars
		static::$templateVars['content'] = $productContent;

		// set() ONLY works on public_header vars -- all fixed vals set in main.php
    // $this->container->view->set('content', "test templating w/search/repl");
		static::$container->view->set('page_title', "Products");

		$maintemplate = TEMPLATE_PATH . DS . 'main.php';
		static::$container->view->renderWithVariables($maintemplate, static::$templateVars);
          // , $optiondefltprint=true
  }
}
