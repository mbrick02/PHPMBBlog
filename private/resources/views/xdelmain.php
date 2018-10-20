<?php
// based on views/main.blade.php of Laravel 2016 Build Blog
// also look at resources/views/templates/app.twig in PHP Slim framework Authentication 6/29
// header has: page_title, urlForIndex, urlForMBBloglogo
// 'container->' interpolated by parent/base __get() when getting view vals
global $g_templateVars;

$this->container->view->filename = TEMPLATE_PATH . DS . 'partials' . DS . 'public_header.php';
// header has: page_title, urlForIndex, urlForMBBloglogo, stylesheet
/* 'view' is Template instance usage:		$template->filename = "template2.php";
$template->set('pageTitle', "Template Test");
$template->set('content', "This is a test of templating using search replace.");
OR:
$assignedVars = [ 'pageTitle' => "Template Test", content' =>"Test of search/repl template."  ];
$template->display();		or $template->returnText(); ***** */
$this->container->view->set('page_title', "Template Test");
$this->container->view->set('urlForIndex', "/");
$this->container->view->set('urlForMBBlogLogo', IMG_SRC . "mbBlogLogo.jpg");
$this->container->view->set('stylesheet', getBaseUrl() . '/stylesheets/public.css');
// or $assignedVars = [ 'field1' => 'field1val', 'field2' => 'field2val'];
echo $this->container->view->returnText();



    include TEMPLATE_PATH . DS . 'partials' . DS . 'navhead.php';
?>
<!-- ************** NAV HEAD TRIAL 10/6/18 ******************** -->

			<ul class="nav navbar-nav navbar-right">
				@if(Session::has('cart'))
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
    <!-- create this: ?php include(SHARED_PATH . squt --> call Navhead.php <!-- squt) ? > -->

    <div class="container">
      <!-- include('partials._messages') -->
      <!-- yield('content') DEBUG:*** --><?php echo $g_templateVars['submitTitle']; ?>
      <!-- include('partials._footer') -->

    </div> <!-- end of .container -->

        <!-- include('partials._javascript') -->

        <!-- yield('scripts') -->
<?php include TEMPLATE_PATH . DS . 'partials' . DS . 'public_footer.php'; ?>
