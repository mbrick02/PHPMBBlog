<?php
  // called by Controller::buildPage
  // vars set in Controller or child (eg. AuthController):
  //    $publicHeader, $cartExists, $routeHasProfile, $content, $rightCol;
  global $session;

  echo $publicHeader;
  include TEMPLATE_PATH . DS . 'partials' . DS . 'navhead.php';
?>
<!-- ************** NAV HEAD TRIAL 10/6/18 ******************** -->
			<ul class="nav navbar-nav navbar-right">
        <?php echo "<h2>". $cartExists . "</h2>"; ?>
				@if(Session::has('cart')) xxUse instead>
				<li>
				<a href="{{ route('product.shoppingCart') }}">
					<i class="fa fa-shopping-cart" aria-hidden="true"></i> Shopping Cart
					  <span class="badge">
                	    {{ Session::has('cart') ? Session::get('cart')->totalQty : '' }}
                	  </span>
                </a>
                </li>
        @endif
                <li><div class="dropdown">
					<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @if(Auth::check()) {{ Auth::user()->fname }} {{ Auth::user()->lname }}  @else  Visitor  @endif
					</button>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                	@if(Auth::check())
                		<a class="dropdown-item {{ Request::is(Route::has('profile')) ? "active" : "" }}" href="/profile/{{ Auth::user()->id }}">
                    <?php echo "<h1>". $routeHasProfile . "</h1>"; ?>
                		User Profile (update)</a>
                		<div class="dropdown-divider"></div>
                		<a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                	@else
                		<a class="dropdown-item" href="{{ route('signup') }}">Signup</a>
                		<a class="dropdown-item" href="{{ route('login') }}">Signin</a>
                	@endif
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
