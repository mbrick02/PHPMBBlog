<?php
  // called by Controller::buildPage
  // vars set in Controller or child (eg. AuthController):
  //    $publicHeader, $cartExists, $routeHasProfile, $content, $rightCol;
  global $session;
  $lgdIn = $session->is_logged_in(); // **NOTE: may want all logged-in options set/used in Controller 11/20/18
  // $lgOut = "<br /><a href=\"/user/logout\">Logout</a>";
  echo $publicHeader;
  include TEMPLATE_PATH . DS . 'partials' . DS . 'navhead.php';
?>
<!-- ************** NAV HEAD TRIAL 10/6/18 ******************** -->
			<ul class="nav navbar-nav navbar-right">
        <li><?php echo "<span class=\"glyphicon glyphicon-shopping-cart\"></span>&nbsp;". $cartExists; ?></li>
				<?php // echo "<h4>" . ($lgdIn ? "Logged In" : "Not logged in") . "</h4><br>";
          // move above to CONTROLLER 11/20
        ?><br>
        <li><div class="dropdown">
                <?php if($lgdIn) {  // move this to controller???? ?>
                <?php echo $userButton; } else { // "Logged in as: " . $session->username . $lgOut; ?>
                <?php   echo $userButton; } ?>

					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item">
                <?php echo $loginOrProfile; ?><div class="dropdown-divider"></div>
                <div><a class="dropdown-item" href="#">Other Menu Option</a></div>
              </a>
              <!-- User Profile (update), Login, logout, Signup/Create in Controller->$loginOrProfile -->
          </div>
				</div></li>
			</ul>
		</div><!-- /.navbar-collapse -->
    </div> <!-- /.container-fluid -->
	</nav>
</div>



<!-- ************  END NAV HEAD TRIAL 10/16/18 ******************** -->
    <div class="row container">
      <!-- include('partials._messages') -->
      <?php echo $content; ?>
      <?php echo $rightCol; ?>

    </div> <!-- end of .container -->

        <!-- include('partials._javascript') -->

        <!-- yield('scripts') -->
<?php include TEMPLATE_PATH . DS . 'partials' . DS . 'public_footer.php'; ?>
