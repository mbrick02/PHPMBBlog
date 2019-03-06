<!doctype html>
<html lang="en">
  <head>
    <?php
      global $session;
      $cartExists = $session->exists('cart') ? $session->get('cart')['totalQty'] : 'No Cart';

      $htmlTitle = "MB Blog Home";
      $webTitle = "MB Blog";
      $urlForIndex = "/";
      $urlForMBBlogLogo = IMG_SRC . "mbBlogLogo.jpg";
      $locStylesheet = getBaseUrl() . 'stylesheets/public.css';
      // ???2/22/19: do we pass in $menuStructure and $loginForm ?????
      $indnt = "    ";
      $indnt3 = $indnt . $indnt . $indnt;
      $indnt5 = $indnt3 . $indnt . $indnt;

      // <!-- 2018 bstrap compiled and minified CSS -->
      /* link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
      integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
      crossorigin="anonymous" */
      $bstrapCSSHref = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css";
      $bstrapCSSInteg = "sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u";
      $bstrapCSSOrg = "anonymous";
      $bstrapCSSIntegStr = "href=\"" . $bstrapCSSHref . "\" \n   integrity=\"" . $bstrapCSSInteg . "\" ";
      $bstrapCSSIntegStr .= "\n   crossorigin=\"" . $bstrapCSSOrg . "\" \n";

      /* <!-- link rel="stylesheet" media="all" href="<?php echo $locStylesheet; ?>" />
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src=""></script>  --> */
      $pageJquery = "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js";
      $pageBstrpJS = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js";

      $loginOrProfile = ""; // eventually use immediate below but cur test use next section 2/27/19
      /*
      // from orig buildLoginForm via userOptions from buildPage in Controller content:
      $loginFormPth = VIEWS_PATH . DS . 'auth' . DS . 'loginForm.php';
      $user = User::getInstance($db); // note: base on db but NOT from -- poss. added user
      $formVars = ['user' => $user];
      $loginFormContent = static::$container->view->
       renderWithVariables($loginFormPth, $formVars, false);

       return $loginFormContent;
      */

      $loginOrProfile = $indnt3 . $indnt . '<form action="/user/login" method="post">' . "\n";
      $loginOrProfile .= $indnt5 . '<input type="hidden" name="login[token]" value="2e23d713d3e6de798586a4976eebdc81" class="form-control">' . "\n";
      $loginOrProfile .= $indnt5 . $indnt . '<fieldset id="inputs" class="fieldset">' . "\n";
      $loginOrProfile .= $indnt5 . $indnt . $indnt . '<label for="login[usernameOREmail]">Username or Email:</label>' . "\n";
      $loginOrProfile .= $indnt5 . $indnt . $indnt . '<input name="login[usernameOREmail]" type="text" placeholder="uname_or_email@dom.com"';
      $loginOrProfile .= $indnt5 . $indnt . $indnt . ' id="usernameOREmail" class="form-control">' . "\n";
      $loginOrProfile .= $indnt5 . $indnt . $indnt . '<label for="login[password]">Password:</label>' . "\n";
      $loginOrProfile .= $indnt5 . $indnt . $indnt . '<input type="password" name="login[password]" id="password" class="form-control">' . "\n";
      $loginOrProfile .= $indnt5 . $indnt . '</fieldset>' . "\n";
      $loginOrProfile .= $indnt5 . $indnt . '<fieldset id="actions" class="fieldset">' . "\n";
      $loginOrProfile .= $indnt5 . $indnt . $indnt . '<input type="submit" name="login[Login]" value="Login" class="submitbtn">' . "\n";
      $loginOrProfile .= $indnt5 . $indnt . $indnt . '<div class="lblNcheckbox" id="remember_me">' . "\n";
      $loginOrProfile .= $indnt5 . $indnt . $indnt . '<label class="checkboxLbl" for="login[remember_me]">Remember Me:</label>' . "\n";
      $loginOrProfile .= $indnt5 . $indnt . $indnt . '<span class="checkbox">' . "\n";
      $loginOrProfile .= $indnt5 . $indnt . $indnt . '<input type="checkbox" name="login[remember_me]" id="remember_me" class="checkbox" value="1" checked>' . "\n";
      $loginOrProfile .= $indnt5 . $indnt . $indnt . '</span>' . "\n";
      $loginOrProfile .= $indnt5 . $indnt . $indnt . '</div>' . "\n";
      $loginOrProfile .= $indnt5 . $indnt . '</fieldset>' . "\n";
      $loginOrProfile .= $indnt5 . '</form>' . "\n";
      /*
      <form action="/user/login" method="post">
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
      */

      $userButton = '<a id="login-trigger" href="#" class="btn btn-secondary dropdown-toggle" type="button"';
      $userButton .= ' data-toggle="login-content" aria-haspopup="true" aria-expanded="false">Login <span>▼</span></a>' . "\n";
      $userButton .= ' or <a href="/user/create">Create User</a>' . "\n";

      $localscripts = "";
      $localscripts .= <<<'LOCAL_SCRIPT'
  <script>
    // trying to make submenu have a higher z-index so it doesn't shove next row down
    // from stackoverflow :
    // $(this).parent().css('position', 'relative');
    // $(this).parent().css('z-index', 3000);
      $(document).ready(function(){
      $('#login-trigger').click(function(){
          $('#login-content').slideToggle(); // was dropdownMenuButton (this).next().next
          $("#login-content").toggleClass('active');

          if ($("#login-content").hasClass('active')) $(this).find('span').html('&#x25B2;')
            else $(this).find('span').html('&#x25BC;')
          })
      });
    </script>
LOCAL_SCRIPT;

      // original concespt for presenting messages:   <!-- include('partials._messages') -->
      $content = $indnt3 . $indnt . '<div class="col-md-6 col-md-offset-1 float-left">' . "\n";
      $content .= $indnt3 . $indnt . '<div class="panel-heading">' . "\n";
      $content .= $indnt3 . $indnt . '<h2>MB Blog</h2>' . "\n";
      $content .= $indnt3 . $indnt . '</div>' . "\n";
      $content .= $indnt3 . $indnt . '<div class="panel-body">Welcome to MB Blog</div>' . "\n";
      $content .= $indnt3 . $indnt . '</div>' . "\n";

      $rightCol = $indnt3 . $indnt . '<div class="float-right my-lg-0">' . "\n";
      $rightCol .= $indnt5 . '<div class="my-lg-0">' . "\n";
      $rightCol .= $indnt5 . $indnt . '<h3>right side info passed in for user</h3>' . "\n";
      $rightCol .= $indnt3 . $indnt . '</div></div>' . "\n";

    include TEMPLATE_PATH . DS . 'partials' . DS . 'newPublicHead.php';
  ?>
</head>
<body>
<header class="row">
  <?php
    include TEMPLATE_PATH . DS . 'partials' . DS . 'newHeaderSec.php';
    include TEMPLATE_PATH . DS . 'partials' . DS . 'newNavhead.php';
  ?>
</header>
<div class="row container">
  <!-- include('partials._messages') -->
  <?php echo $content; ?>
  <?php echo $rightCol; ?>
</div> <!-- end of .container -->

    <!-- include('partials._javascript') -->

<?php include TEMPLATE_PATH . DS . 'partials' . DS . 'public_footer.php'; ?>


</body>
</html>
