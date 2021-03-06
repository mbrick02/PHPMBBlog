<?php
  // echo $publicHeader; // currently in newMain: Logo, Page title, errs or oth msgs - partials/public_header

  // 3-line "hamburger" menu button for mobile device menu
  $hamburgBtn = $indnt3 . '<button type="button" class="navbar-toggle" data-toggle="collapse"' . "\n";
  $hamburgBtn .= $indnt3 . $indnt . 'data-target="#bs-example-navbar-collapse-1">' . "\n";
  $hamburgBtn .= $indnt5 . '<span class="sr-only">Toggle navigation</span>' . "\n";
  $hamburgBtn .= $indnt5 . '<span class="icon-bar"></span>' . "\n";
  $hamburgBtn .= $indnt5 . '<span class="icon-bar"></span>' . "\n";
  $hamburgBtn .= $indnt5 . '<span class="icon-bar"></span>' . "\n";
  $hamburgBtn .= $indnt3 . $indnt . '</button>' . "\n";

  $brand = $indnt3 . $indnt . '<a class="navbar-brand" href="#">Brand</a>' . "\n";

  $navMnuL = $indnt3 . $indnt . '<ul class="nav navbar-nav"><!-- left side menu bar -->' . "\n";
  $navMnuL .= $indnt5 . '<li><a href="#">Home</a></li>' . "\n";
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
  $navMnuL .= $indnt5 . '<li><a href="#">About</a></li>' . "\n";
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
  //  <!-- User Profile (update), Login, logout, Signup/Create in Controller->$loginOrProfile -->
  $navMnuR .= $indnt5 . $indnt . '</div>' . "\n";
  $navMnuR .= $indnt5 . $indnt . '</div></li>' . "\n";
  $navMnuR .= $indnt5 . $indnt . '</ul>' . "\n";
  $navMnuR .= $indnt5 . '</li>' . "\n";
  $navMnuR .= $indnt3 . $indnt . '</ul>' . "\n";

    /*  current right menu (w/login form):
    <ul class="nav navbar-nav navbar-right">
      <li><?php echo "<span class=\"glyphicon glyphicon-shopping-cart\"></span>&nbsp;". $cartExists; ?></li>
      <?php // echo "<h4>" . ($lgdIn ? "Logged In" : "Not logged in") . "</h4><br>";
        // move above to CONTROLLER 11/20
      ?><br>
      <li id="login"><div class="dropdown">
              <?php echo $userButton;
              // moved logic to controller (for now - later: model?): if($lgdIn){} else { }
              ?>
        <div id="login-content" class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <div>
              <a class="dropdown-item"><?php echo $loginOrProfile; ?></a>
            </div>
            <div class="dropdown-divider"><a class="dropdown-item"></a></div>
            <div><a class="dropdown-item" href="#">Other Menu Option</a></div>
            <!-- User Profile (update), Login, logout, Signup/Create in Controller->$loginOrProfile -->
        </div>
      </div></li>
    </ul>
    <!-- above is right menu below ends the section(s)
  </div><!-- /.navbar-collapse -->
  </div> <!-- /.container-fluid -->
  </nav>
    */
    // page HTML BEGINS below
?>

 <div class="blog-masthead">
   <nav class="navbar navbar-default">
     <!--  navbar navbar-expand-lg navbar-light bg-light -->
     <!-- Brand and toggle get grouped for better mobile display -->
     <div class="container">
         <div class="navbar-header"><!-- This makes hamburger icon for small screens -->
           <?php echo $hamburgBtn; ?>
           <?php echo $brand; ?>
         </div>
         <!-- Collect the nav links, forms, and other content for toggling -->
         <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
           <?php echo $navMnuL; ?>
           <?php echo $navMnuR; ?>
         </div><!-- /.navbar-collapse -->
     </div>
   </nav>
 </div><!-- masthead -->
