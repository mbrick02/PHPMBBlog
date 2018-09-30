<?php

// pass in entire $container to make it available to all 'child'/extended controllers

namespace app\controllers;

class Controller {
	protected $container;

  public function __construct($container) {
		/* ** DEBUG: var_dump($container);
		echo "<br />"; */
		$this->container = $container;
		// container defined in bootstrap/app.php
   }
/* using __get() in this way does not seem to work in php 7.1.22 */
  public function __get($property) {  // can be used to create shortcut calls to property values
	    // ***WARNING if overused, these shortcuts can be confusing
			// ** DEBUG: var_dump($property);
			if ($this->container->{$property}) {
	        return $this->container->{$property};
					// if prop in container, get w/out specifying container
					// e.g HomeConroller->view instead HomeController->container->view
        }
  }

	public function __set($property, $value) {  // can be used to create shortcut calls to property values
	    // ***WARNING if overused, these shortcuts can be confusing
			// ** DEBUG:
			echo "What is this property";
			if ($this->container->{$property}) {
	        // $this->container->{$property} = $value;
					// if prop in container, set w/out spec. container
					// e.g HomeConroller->view= $val instead HomeController->container->view = $val
        }
  }

}
