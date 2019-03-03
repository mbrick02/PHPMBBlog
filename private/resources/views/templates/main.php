<?php
  // called by Controller::buildPage
  // vars set in Controller or child (eg. AuthController):
  //    $publicHeader, $cartExists, $routeHasProfile, $content, $rightCol;
  global $session;
  $lgdIn = $session->is_logged_in(); // **NOTE: may want all logged-in options set/used in Controller 11/20/18
  // $lgOut = "<br /><a href=\"/user/logout\">Logout</a>";

  $indnt = "    ";
  $indnt3 = $indnt . $indnt . $indnt;
  $indnt5 = $indnt3 . $indnt . $indnt;

  // 3-line "hamburger" menu button for mobile device menu
  $hamburgBtn = $indnt3 . '<button type="button" class="navbar-toggle" data-toggle="collapse" ';
  $hamburgBtn .= $indnt3 . $indnt . 'data-target="#bs-example-navbar-collapse-1">' . "\n";
  $hamburgBtn .= $indnt5 . '<span class="sr-only">Toggle navigation</span>' . "\n";
  $hamburgBtn .= $indnt5 . '<span class="icon-bar"></span>' . "\n";
  $hamburgBtn .= $indnt5 . '<span class="icon-bar"></span>' . "\n";
  $hamburgBtn .= $indnt5 . '<span class="icon-bar"></span>' . "\n";
  $hamburgBtn .= $indnt3 . $indnt . '</button>' . "\n";

  $navMnuL = $indnt3 . $indnt . '<ul class="nav navbar-nav"><!-- left side menu bar -->' . "\n";
  $navMnuL .= $indnt5 . '<li><a class="' . (($pageUrls['curURL'] == '/') ? 'active' : '') . '" href="/">Home</a></li>' . "\n";
  $navMnuL .= $indnt5 . '<li class="dropdown">' . "\n";
  $navMnuL .= $indnt5 . $indnt . '<a href="#" data-toggle="dropdown" class="dropdown-toggle">' . "\n";
  $navMnuL .= 'Submenu <b class="caret"></b></a>' . "\n";
  $navMnuL .= $indnt5 . $indnt . '<ul class="dropdown-menu">' . "\n";
  $navMnuL .= $indnt5 . $indnt . $indnt . '<li><a href="#">Link1</a></li>' . "\n";
  $navMnuL .= $indnt5 . $indnt . $indnt . '<li><a href="#">Link2</a></li>' . "\n";
  $navMnuL .= $indnt5 . $indnt . $indnt . '<li><a href="#">Link3</a></li>' . "\n";
  $navMnuL .= $indnt5 . $indnt . $indnt . '<li class="divider"></li>' . "\n";
  $navMnuL .= $indnt5 . $indnt . $indnt . '<li><a href="#">Link4</a></li>' . "\n";
  $navMnuL .= $indnt5 . $indnt . '</ul>' . "\n";
  $navMnuL .= $indnt5 . '</li>' . "\n";
  $navMnuL .= $indnt5 . '<li><a href="#" class="nav-link nav-item' . (($pageUrls['curURL'] == '/about') ? ' active' : '') . '">About</a></li>' . "\n";
  $navMnuL .= $indnt3 . $indnt . '</ul>' . "\n";

  $navMnuR = $indnt3 . $indnt . '<ul class="nav navbar-nav navbar-right"> <!-- rt side menu -->' . "\n";
  $navMnuR .= $indnt5 . '<li> <span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;' . $cartExists . '</li>' . "\n";
  $navMnuR .= $indnt5 . $indnt . '<li id="login"><div class="dropdown">' . "\n";
  $navMnuR .= $indnt5 . $indnt . $indnt . $userButton;
  $navMnuR .= $indnt5 . $indnt . '<div id="login-content" class="dropdown-menu" aria-labelledby="dropdownMenuButton">' . "\n";
  $navMnuR .= $indnt5 . $indnt . $indnt . '<div>' . "\n";
  $navMnuR .= $indnt5 . $indnt3 . '<a class="dropdown-item">' . $loginOrProfile . '</a>' . "\n";
  $navMnuR .= $indnt5 . $indnt . $indnt . '</div>' . "\n";
  $navMnuR .= $indnt5 . $indnt . $indnt . '<div class="dropdown-divider"><a class="dropdown-item"></a></div>' . "\n";
  $navMnuR .= $indnt5 . $indnt . '<div><a class="dropdown-item" href="#">Other Menu Option</a></div>' . "\n";
  //  <!-- OLD setup had: User Profile (update), Login, logout, Signup/Create in Controller->$loginOrProfile -->
  $navMnuR .= $indnt5 . $indnt . '</div>' . "\n";
  $navMnuR .= $indnt5 . $indnt . '</div></li>' . "\n";
  $navMnuR .= $indnt5 . $indnt . '</ul>' . "\n";
  $navMnuR .= $indnt5 . '</li>' . "\n";
  $navMnuR .= $indnt3 . $indnt . '</ul>' . "\n";

  // include TEMPLATE_PATH . DS . 'partials' . DS . 'public_header.php';
  echo $publicHeader; // Logo, Page title, errors or other messages via partials/public_header
  include TEMPLATE_PATH . DS . 'partials' . DS . 'navhead.php'; // navigation menu
?>

    <div class="row container">
      <!-- include('partials._messages') -->
      <?php echo $content; ?>
      <?php echo $rightCol; ?>

    </div> <!-- end of .container -->

        <!-- include('partials._javascript') -->

        <!-- yield('scripts') -->
<?php include TEMPLATE_PATH . DS . 'partials' . DS . 'public_footer.php'; ?>
