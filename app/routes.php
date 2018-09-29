<?php

// ***APPARENTLY YOU CAN ONLY AUTOLOAD CLASSES
// (Skoglund) Autoload class definitions
// see my_autoload in intialize.php
/* function route_autoload($route) {
  if(preg_match('/\A\w+\Z/', $route)) {
      require_once('routes/' . strtolower($route) . '.php');
  } // had to use strtolower -- for some reason linux (only) would cap Session
}
spl_autoload_register('route_autoload'); */

require_once('routes/products.php');
