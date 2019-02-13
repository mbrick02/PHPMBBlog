<!doctype html>

<html lang="en">
  <head>
    <title>MB Blog Page Home</title>
    <meta charset="utf-8">
    <!-- Latest bstrap compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
    integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
    crossorigin="anonymous">
    <link rel="stylesheet" media="all" href="http://phpmbblog.org/stylesheets/public.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
		$(document).ready(function(){
		$('#login-trigger').click(function(){
				$(this).next().next().slideToggle(); // was dropdownMenuButton (this).next().next
				$("#login-content").toggleClass('active');

				if ($(this).hasClass('active')) $(this).find('span').html('&#x25B2;')
					else $(this).find('span').html('&#x25BC;')
				})
		});
	</script>
  </head>
  <body>
    <header>
      <h1>
        <a href="/">
          <img class="mb-icon" src="http://phpmbblog.org/images/mbBlogLogo.jpg" />MB Blog
        </a>
      </h1>

    </header>

<div class="blog-masthead">
  <nav class="navbar navbar-default">
  		<!--  navbar navbar-expand-lg navbar-light bg-light -->
  	<div class="container container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
    		<div class="navbar-header">

    			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
    			data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
    			aria-expanded="false" aria-label="Toggle navigation">
    				<span class="icon-bar"></span>
    			</button>
    			<a class="navbar-brand" href="/api/products">Brand</a>
    		</div>
    		<!-- Collect the nav links, forms, and oth content for toggling -->
    		<div class="collapse navbar-collapse" id="navbarSupportedContent">
    			<ul class="nav navbar-nav">
    				<li class="active"><a
    						href="/">Home</a></li>
    				<li><a class="nav-link nav-item"
    					  href="#">About</a></li>
    			</ul>
    <!-- ************** NAV HEAD experiment 10/6/18 ******************** -->
    			<ul class="nav navbar-nav navbar-right">
            <li><div><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;No Cart</div></li>
            <li id="login"><div class="dropdown">
                    <a id="login-trigger" href="#" class="btn btn-secondary dropdown-toggle" type="button"
                    data-toggle="login-content" aria-haspopup="true" aria-expanded="false">Login <span>▼</span></a>
                    or <a href="/user/create">Create User</a>
                    <!-- div id="login-content" class="dropdown-menu" aria-labelledby="dropdownMenuButton" -->
                  <!-- *** was div for anchor dropdown-item -->
                  <div id="login-content"> <!-- div was just holding dropdown-item "Other Menu Option" -->
                      <!-- div class="col-md-12 float-left panel-body" id="was login-content" -->
                        <form action="/user/login" method="post">
                        <input type="hidden" name="login[token]" value="0a4aa770788a6ef522c1e2c7b828ee05"
                        class="form-control">
                        <fieldset id='inputs' class='fieldset'>
                           <label for="login[usernameOREmail]">Username or Email:</label>
                           <input name="login[usernameOREmail]" type="text" placeholder="uname_or_email@dom.com"
                           id="usernameOREmail" class="form-control">
                           <label for="login[password]">Password:</label>
                           <input type="password" name="login[password]" id="password" class="form-control">
                        </fieldset>
                        <fieldset id='outputs' class='fieldset'>
                           <input type="submit" name="login[Login]" value="Login" class="btn">
                           <label for="login[remember_me]">Remember Me:</label>
                           <input type="checkbox" name="login[remember_me]" value="1" class="form-control" checked>
                        </fieldset>
                        </form>
                        <!-- was login content holding just form /div -->
                  <!-- *** was /div for anchor dropdown-item  -->
                  <div class="dropdown-divider"><a class="dropdown-item"></a></div>
                  <a class="dropdown-item" href="#">Other Menu Option</a></div>
                  <!-- User Profile (update), Login, logout, Signup/Create in Controller->$loginOrProfile -->
              <!-- /div -->
    				<!-- /div -->
             </li>
    			</ul>
    		</div><!-- /.navbar-collapse -->
      </div> <!-- /.container-fluid -->
	</nav>
</div>
<!-- ************  END NAV HEAD experi 10/16/18 ******************** -->

    <div class="row container">
      <!-- include('partials._messages') -->
      <div class="col-md-6 col-md-offset-1 float-left">
<div class="panel-heading">
<h2>MB Blog</h2></div>
<div class="panel-body">
Welcome to MB Blog</div>
</div>
      <div class="float-right my-lg-0">
<div class="my-lg-0">
<h3>right side info passed in for user</h3></div>
</div>
</div>

    </div> <!-- end of .container -->

        <!-- include('partials._javascript') -->

        <!-- yield('scripts') -->
      <div class="row">
      <footer class="col-sm-6 col-md-8 footnote">
        <p>&copy 2019 Michael Brickler</p>
      </footer>
    </div><!-- end row -->

    </body>
</html>
