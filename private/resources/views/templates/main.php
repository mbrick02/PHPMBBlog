<?php
  global $session;
  // based on views/main.blade.php of Laravel 2016 Build Blog
  // also look at resources/views/templates/app.twig in PHP Slim framework Authentication 6/29
  // header has: page_title, urlForIndex, urlForMBBloglogo
  // 'container->' interpolated by parent/base __get() when getting view vals
  // DEL non longer  uses: global $g_templateVars;

  // $container->view->filename = (Default=TEMPLATE_PATH . DS .) 'partials' . DS . 'public_header.php';
  $container->view->filename = 'partials' . DS . 'public_header.php';

  // header has: page_title, urlForIndex, urlForMBBloglogo, stylesheet, errorHeader
  /* 'view' is Template instance usage:		$template->filename = "template2.php";
  $template->set('pageTitle', "Template Test"); $template->set('content', "some content.");
  OR:
  $assignedVars = [ 'pageTitle' => "Template Test", content' =>"Test of search/repl template."  ];
  $template->display();		or $template->returnText(); ***** */
  // values for header,  like example below, set in calling Controller but CAN be set here
  // $container->view->set('page_title', "Template Test"); // in controller fixed header val set here
  $container->view->set('urlForIndex', "/");
  $container->view->set('urlForMBBlogLogo', IMG_SRC . "mbBlogLogo.jpg");
  // TODO: show backslash before stylesheets 10/29/18
  $container->view->set('stylesheet', getBaseUrl() . 'stylesheets/public.css');

  $msgHeader = "";
  if (Session::exists('message')){
    $msgHeader .= $session->display_session_message();
  } elseif (Session::exists('errors')){
    $msgHeader .= $session->display_errors(Session::errMsg());
  }

  $container->view->set('msgHeader',  $msgHeader);

// DEBUG 10/29 **
  // if (!empty($msgHeader)) {
  //   echo "In main.php -- container->view template assigned vars: <br>";
  //   var_dump($container->view->assignedVars);
  //   die();
  // }

  // or $assignedVars = [ 'field1' => 'field1val', 'field2' => 'field2val'];
  $output = $container->view->returnText();
  // DEBUG 10/29 **************************
  if (!empty($msgHeader)) {
    // echo "In main.php -- container->view template assigned vars: <br>";
    // var_dump($container->view->assignedVars);
    // echo "<br>In main.php -- msgHeader var: <br>";
    // var_dump($msgHeader);
    // echo "<br>In main.php -- output from retrnText: <br>";
    // var_dump($output);
    // die();
  }
  echo $output;

  include TEMPLATE_PATH . DS . 'partials' . DS . 'navhead.php';

?>
<!-- ************** NAV HEAD TRIAL 10/6/18 ******************** -->

			<ul class="nav navbar-nav navbar-right">
        <?php echo "<h1>". $cartExists . "</h1>"; ?>
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
