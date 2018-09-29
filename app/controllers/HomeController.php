<?php

namespace App\Controllers;

use Slim\Views\Twig as View;

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
    return $this->view->render($response, 'home.twig');  // container interpolated by parent/base __get()
  }
}
