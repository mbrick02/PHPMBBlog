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
    // $this(HomeConroller)->view;????
		$this->view->filename = 'main.php'; // should be the default
		// $page_title = <****?????php if(isset($page_title)) { echo '- ' . h($page_title); };
		$this->view->set('pageTitle', "Template Test");
		$this->view->set('content', "This is a test of templating using search replace.");

		/* 'view' is currently a Template instance usage:
		$template = new Template();
		$template->filename = "template2.php";
		$template->set('pageTitle', "Template Test");
		$template->set('content', "This is a test of templating using search replace.");
		$template->display();
		or $template->returnText();
		*/
		// DEBUG **: var_dump($request->getParam('name'));
		// DEBUG **: return "This is the HomeController for index/home page";
		return $this->view->display();
  }
}
