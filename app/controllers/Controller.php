<?php

// pass in entire $container to make it available to all 'child'/extended controllers

namespace App\Controllers;

class Controller {
	protected $container;

  public function __construct($container) {
	   $this->container = $container;
   }

  public function __get($property) {  // can be used to create shortcut calls to property values
	    // ***WARNING if overused, these shortcuts can be confusing
	     if ($this->container->{$property}) {
	        return $this->container->{$property}; // if property in container, produce w/out spec. container
        }
  }
}
