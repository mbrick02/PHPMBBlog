<?php
// based on views/main.blade.php of Laravel 2016 Build Blog
// also look at resources/views/templates/app.twig in PHP Slim framework Authentication 6/29
// header has: page_title, urlForIndex, urlForMBBloglogo
?>

<?php


include(SHARED_PATH . DS . 'public_header.php');

?>

    <!-- create this: ?php include(SHARED_PATH . squt --> navhead.php <!-- squt) ? > -->

    <div class="container">
      <!-- include('partials._messages') -->

      <!-- yield('content') DEBUG:*** --><h1>content</h1>

      <!-- include('partials._footer') -->

    </div> <!-- end of .container -->

        <!-- include('partials._javascript') -->

        <!-- yield('scripts') -->
<?php include(SHARED_PATH . DS . 'public_footer.php'); ?>
