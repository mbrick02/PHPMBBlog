<?php
  // echo $publicHeader; // currently in newMain: Logo, Page title, errs or oth msgs - partials/public_header
  $indnt = "    ";
  $indnt3 = $indnt . $indnt . $indnt;
  $indnt5 = $indnt3 . $indnt . $indnt;
  // 3-line "hamburger" menu button for mobile device menu
  $hamburgBtn = $indnt3 . '<button type="button" class="navbar-toggle" data-toggle="collapse"' . "\n";
  $hamburgBtn .= $indnt3 . $indnt . 'data-target="#bs-example-navbar-collapse-1">' . "\n";
  $hamburgBtn .= $indnt5 . '<span class="sr-only">Toggle navigation</span>' . "\n";
  $hamburgBtn .= $indnt5 . '<span class="icon-bar"></span>' . "\n";
  $hamburgBtn .= $indnt5 . '<span class="icon-bar"></span>' . "\n";
  $hamburgBtn .= $indnt5 . '<span class="icon-bar"></span>' . "\n";
  $hamburgBtn .= $indnt3 . $indnt . '</button>' . "\n";

  $brand = $indnt3 . $indnt . '<a class="navbar-brand" href="#">Brand</a>' . "\n";

  $navMnuL = $indnt3 . $indnt . '<ul class="nav navbar-nav"><!-- left side menu bar -->';
  $navMnuL .= $indnt5 . '<li><a href="#">Home</a></li>';
  $navMnuL .= $indnt5 . '<li class="dropdown">';
  $navMnuL .= $indnt5 . $indnt . '<a href="#" data-toggle="dropdown" class="dropdown-toggle">Submenu <b class="caret"></b></a>';
  $navMnuL .= $indnt5 . $indnt . '<ul class="dropdown-menu">';
  $navMnuL .= $indnt5 . $indnt . $indnt . '<li><a href="#">Link1</a></li>';
  $navMnuL .= $indnt5 . $indnt . $indnt . '<li><a href="#">Link2</a></li>';
  $navMnuL .= $indnt5 . $indnt . $indnt . '<li><a href="#">Link3</a></li>';
  $navMnuL .= $indnt5 . $indnt . $indnt . '<li class="divider"></li>';
  $navMnuL .= $indnt5 . $indnt . $indnt . '<li><a href="#">Link4</a></li>';
  $navMnuL .= $indnt5 . $indnt . '</ul>';
  $navMnuL .= $indnt5 . '</li>';
  $navMnuL .= $indnt5 . '<li><a href="#">About</a></li>';
  $navMnuL .= $indnt3 . $indnt . '</ul>';

  /*
  <ul class="nav navbar-nav"><!-- left side menu bar -->
      <li><a href="#">Home</a></li>
      <li><a href="#">Profile</a></li>
      <li class="dropdown">
          <a href="#" data-toggle="dropdown" class="dropdown-toggle">Messages <b class="caret"></b></a>
          <ul class="dropdown-menu">
              <li><a href="#">Inbox</a></li> <!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
              <li><a href="#">Drafts</a></li>
              <li><a href="#">Sent Items</a></li>
              <li class="divider"></li>
              <li><a href="#">Trash</a></li>
          </ul>
      </li>
  </ul>

  */

  $navMnuR = $indnt3 . $indnt . '<ul class="nav navbar-nav navbar-right"> <!-- rt side menu -->';
  $navMnuR .= $indnt5 . '<li class="dropdown">';
  $navMnuR .= $indnt5 . $indnt . '<a href="#" data-toggle="dropdown" class="dropdown-toggle">Admin <b class="caret"></b></a>';
  $navMnuR .= $indnt5 . $indnt . '<ul class="dropdown-menu">';
  $navMnuR .= $indnt5 . $indnt . $indnt . '<li><a href="#">Action</a></li>';
  $navMnuR .= $indnt5 . $indnt . $indnt . '<li><a href="#">Another action</a></li>';
  $navMnuR .= $indnt5 . $indnt . $indnt . '<li class="divider"></li>';
  $navMnuR .= $indnt5 . $indnt . $indnt . '<li><a href="#">Settings</a></li>';
  $navMnuR .= $indnt5 . $indnt . '</ul>';
  $navMnuR .= $indnt5 . '</li>';
  $navMnuR .= $indnt3 . $indnt . '</ul>';

  /*  sample/test right menu:
  <ul class="nav navbar-nav navbar-right"> <!-- right side menu -->
    <!-- on-page (rather than live demo) shows: ul class="nav pull-right" -->
      <li class="dropdown">
          <a href="#" data-toggle="dropdown" class="dropdown-toggle">Admin <b class="caret"></b></a>
          <ul class="dropdown-menu">
              <li><a href="#">Action</a></li>
              <li><a href="#">Another action</a></li>
              <li class="divider"></li>
              <li><a href="#">Settings</a></li>
          </ul>
      </li>
  </ul>
  */

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

  /* current rightside menu with vars expanded:
  <ul class="nav navbar-nav navbar-right">
        <li><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;No Cart</li>
				<br>
        <li id="login"><div class="dropdown">
                <a id="login-trigger" href="#" class="btn btn-secondary dropdown-toggle" type="button" data-toggle="login-content" aria-haspopup="true" aria-expanded="false">Login <span>▼</span></a> or <a href="/user/create">Create User</a>					<div id="login-content" class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <div>
                <a class="dropdown-item"><form action="/user/login" method="post">
<input type="hidden" name="login[token]" value="2e23d713d3e6de798586a4976eebdc81" class="form-control">
<fieldset id='inputs' class='fieldset'>
    <label for="login[usernameOREmail]">Username or Email:</label>

        <input name="login[usernameOREmail]" type="text" placeholder="uname_or_email@dom.com" id="usernameOREmail" class="form-control">
    <label for="login[password]">Password:</label>

        <input type="password" name="login[password]" id="password" class="form-control">
</fieldset>
<fieldset id='actions' class='fieldset'>

        <input type="submit" name="login[Login]" value="Login" class="submitbtn">
<div class="lblNcheckbox" id="remember_me">
        <label class="checkboxLbl" for="login[remember_me]">Remember Me:</label>

            <span class="checkbox">
        <input type="checkbox" name="login[remember_me]" id="remember_me" class="checkbox" value="1" checked>

    </span>

    </div>
</fieldset>
</form>
</a>
              </div>
              <div class="dropdown-divider"><a class="dropdown-item"></a></div>
              <div><a class="dropdown-item" href="#">Other Menu Option</a></div>
              <!-- User Profile (update), Login, logout, Signup/Create in Controller->$loginOrProfile -->
          </div>
				</div></li>
			</ul>
		</div><!-- /.navbar-collapse -->
    </div> <!-- /.container-fluid -->
	</nav>
  */


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
