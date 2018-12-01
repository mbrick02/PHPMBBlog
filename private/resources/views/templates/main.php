<?php
  // called by Controller::buildPage
  // vars set in Controller or child (eg. AuthController):
  //    $publicHeader, $cartExists, $routeHasProfile, $content, $rightCol;
  global $session;
  $lgdIn = $session->is_logged_in(); // **NOTE: may want all logged-in options set/used in Controller 11/20/18
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
                <?php if($lgdIn) { ?>
                <?php echo "Logged in as: " . $session->username; } else {  ?>
                <?php   echo $userButton; } ?>

					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                	<!-- @ if(Auth::check()) -->
                		<a class="dropdown-item {{ Request::is(Route::has('profile')) ? "active" : "" }}" href="/profile/{{ Auth::user()->id }}">
                    <?php echo $loginOrProfile; ?>
                		<!-- User Profile (update) --></a>
                		<div class="dropdown-divider"></div>
                		<a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                	<!-- @ else -->
                		<a class="dropdown-item" href="{{ route('signup') }}">Signup</a>
                		<a class="dropdown-item" href="{{ route('login') }}">Signin</a>
                	<!-- @ endif -->
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
