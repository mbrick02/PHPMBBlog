<?php
  // called by Controller::buildPage
  // vars set in Controller or child (eg. AuthController):
  //    $publicHeader, $cartExists, $routeHasProfile, $content, $rightCol;
  global $session;
  $lgdIn = $session->is_logged_in(); // **NOTE: may want all logged-in options set/used in Controller 11/20/18
  // $lgOut = "<br /><a href=\"/user/logout\">Logout</a>";
  echo $publicHeader; // Logo, Page title, errors or other messages via partials/public_header
  include TEMPLATE_PATH . DS . 'partials' . DS . 'navhead.php'; // navigation menu
?>
<!-- ************** NAV HEAD experiment 10/6/18 ******************** -->
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
		</div><!-- /.navbar-collapse -->
    </div> <!-- /.container-fluid -->
	</nav>
</div>
<!-- ************  END NAV HEAD experi 10/16/18 ******************** -->

    <div class="row container">
      <!-- include('partials._messages') -->
      <?php echo $content; ?>
      <?php echo $rightCol; ?>

    </div> <!-- end of .container -->

        <!-- include('partials._javascript') -->

        <!-- yield('scripts') -->
<?php include TEMPLATE_PATH . DS . 'partials' . DS . 'public_footer.php'; ?>
