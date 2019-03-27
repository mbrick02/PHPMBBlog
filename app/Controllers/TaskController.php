<?php
// '/products' and other urls use named url with urlFor()
//Create a named route: (->name() or setName()?) in Routes/Products.php
// $app->get('/hello/:arg1', function ($name) use ($app) {  echo "Hello $name";})->name('hello');

namespace app\Controllers;
use app\Models\Task as Task;
use app\specialClasses\FormBuild as FormBuild;
// use app\Models\DBConnect as DBConnect;
// If we use Twig Views: use Slim\Views\Twig as View;

class TaskController extends Controller {

	public function index($request, $response) {
		// $product = Product::getInstance();
		$tasks = Task::getAll();

		$taskContent = "";
		$taskContent .= FormBuild::retTag("div", ['class' => 'col-md-6 col-md-offset-1 float-left']);

		if(!isset($tasks['rowCount'])) {
			$taskContent .= '\n<h2>No tasks</h2>';
		} else {
			// controllers/products@show)
			foreach($tasks['records'] as $task) {
				$taskContent .= "<h2>". $task->title . "</h2><br>";
			}
		}
		$taskContent .= FormBuild::endTag('div');
		// $htmlSections = [	'doubtUse' =>"Doubt this will be useful",];
    // give vals to main.php template vars
		static::$templateVars['content'] = $taskContent;

		// set() ONLY works on public_header vars -- all fixed vals set in main.php
    // old: $this->container->view->set('content', "test templating w/search/repl");
		// Old pre buildPage version: static::$container->view->set('page_title', "Products");
		static::$templateVars['page_title'] = "Tasks";

		$maintemplate = TEMPLATE_PATH . DS . 'main.php';
		// old: static::$container->view->renderWithVariables($maintemplate, static::$templateVars);
          // , $optiondefltprint=true
		static::buildPage(static::$templateVars);
  }
}
