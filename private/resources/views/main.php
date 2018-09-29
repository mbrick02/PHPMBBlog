<?php
// based on views/main.blade.php of Laravel 2016 Build Blog
// also look at resources/views/templates/app.twig in PHP Slim framework Authentication 6/29
<!DOCTYPE html>
<html lang="en">
  <head>
    @include('partials._head')
  </head>

  <body>

    @include('partials._nav')

    <div class="container">
      @include('partials._messages')

      @yield('content')

      @include('partials._footer')

    </div> <!-- end of .container -->

        @include('partials._javascript')

        @yield('scripts')

  </body>
</html>
