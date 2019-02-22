<!doctype html>
<html lang="en">
  <head>
    <?php
      $htmlTitle = "MB Blog Home";
      $webTitle = "MB Blog";
      $urlForIndex = "/";
      $urlForMBBlogLogo = IMG_SRC . "mbBlogLogo.jpg";
      $locStylesheet = getBaseUrl() . 'stylesheets/public.css';
      // ???2/22/19: do we pass in $menuStructure and $loginForm ?????

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
      <div class="col-md-6 col-md-offset-1 float-left">
        <div class="panel-heading">
          <h2>MB Blog</h2>
        </div>
        <div class="panel-body">
          Welcome to MB Blog
        </div>

      </div>
      <div class="float-right my-lg-0">
        <div class="my-lg-0">
          <h3>right side info passed in for user</h3>
        </div>
      </div>
<!-- ?extra/unnecessary: /div -->

</div> <!-- end of row container -->
<div class="row">
      <footer class="col-sm-6 col-md-8 footnote">
        <p>&copy 2019 Michael Brickler</p>
      </footer>
</div><!-- end row -->

</body>
</html>
