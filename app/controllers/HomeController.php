<?php

namespace app\controllers;

// If we use Twig Views: use Slim\Views\Twig as View;

class HomeController extends Controller {
	protected $view;  // declare for use in constructor

/*  **** MOVE this to base class Constructor to simplify:
public function __construct(View $view)  // was just passing in view -- now pass in container
{
	$this->view = $view;
}
****** */

	public function index($request, $response)
	{
    // return $this->container->view->render($response, 'home.twig');
    // return $this->view->render($response, 'home.twig');
		// container interpolated by parent/base __get()


		// $this->container->view->filename = 'main.php'; // should be the default
		// ???? $page_title = <****?????php if(isset($page_title)) { echo '- ' . h($page_title); };
		$this->container->view->filename = '/templates/partials/public_header.php';
		// header has: page_title, urlForIndex, urlForMBBloglogo

		$this->container->view->set('page_title', "Template Test");
		$this->container->view->set('urlForIndex', "/api/products");
		$this->container->view->set('urlForMBBlogLogo', url_for("/images/mbBlogLogo.php"));
		// $this->container->view->set('pageTitle', "Template Test");
		$this->container->view->set('content', "This is a test of templating using search replace.");
		echo $this->container->view->returnText();

		echo "<h1>This is a test page</h1>";

		include(SHARED_PATH . DS . 'public_footer.php');

		/* 'view' is currently a Template instance usage:
		$template = new Template();
		$template->filename = "template2.php";
		$template->set('pageTitle', "Template Test");
		$template->set('content', "This is a test of templating using search replace.");
		$template->display();
		or $template->returnText();
		*/
		// DEBUG **: var_dump($request->getParam('name'));
		// DEBUG **: return "<br />index/home view-filename set in HomeController";
		// DEBUG **: $output = header, $output .= body, $output .= footer;
		// return $this->container->view->display();
		// include(VIEWS_PATH . DS . "main.php");
  }
}
