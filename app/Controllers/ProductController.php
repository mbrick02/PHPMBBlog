<?php
// '/products' and other urls use named url with urlFor()
//Create a named route: (->name() or setName()?) in Routes/Products.php
// $app->get('/hello/:arg1', function ($name) use ($app) {  echo "Hello $name";})->name('hello');

namespace app\Controllers;
use app\Models\Product as Product;
use app\specialClasses\FormBuild as FormBuild;
// use app\Models\DBConnect as DBConnect;
// If we use Twig Views: use Slim\Views\Twig as View;

class ProductController extends Controller {

	public function index($request, $response) {
		// $product = Product::getInstance();
		$products = Product::getAll();

		$productContent = "";
		$productContent .= FormBuild::retTag("div", ['class' => 'col-md-6 col-md-offset-1 float-left']);

		if(!isset($products['rowCount'])) {
			$productContent .= '\n<h2>No products</h2>';
		} else {
			// controllers/products@show)
			foreach($products['records'] as $product) {
				$productContent .= "<h2>". $product->title . "</h2><br>";
			}
		}
		$productContent .= FormBuild::endTag('div');
		// $htmlSections = [	'doubtUse' =>"Doubt this will be useful",];
    // give vals to main.php template vars
		static::$templateVars['content'] = $productContent;

		// set() ONLY works on public_header vars -- all fixed vals set in main.php
    // old: $this->container->view->set('content', "test templating w/search/repl");
		// Old pre buildPage version: static::$container->view->set('page_title', "Products");
		static::$templateVars['page_title'] = "Products";

		$maintemplate = TEMPLATE_PATH . DS . 'main.php';
		// old: static::$container->view->renderWithVariables($maintemplate, static::$templateVars);
          // , $optiondefltprint=true
		static::buildPage(static::$templateVars);
  }
}
