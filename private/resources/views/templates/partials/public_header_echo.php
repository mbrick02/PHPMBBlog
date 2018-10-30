<!doctype html>

<html lang="en">
  <head>
    <title>MB Blog Page <?php echo {$page_title} ?></title>
    <meta charset="utf-8">
    <!-- Latest bstrap compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
    integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
    crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" media="all" href="<?php echo $stylesheet ?> " />
  </head>
  <body>
    <header>
      <h1>
        <a href="<?php echo $urlForIndex; ?>">
          <img class="mb-icon" src="<?php echo $urlForMBlogLogo; ?>" />MB Blog
        </a>
      </h1>
      <?php echo $msgHeader; ?>
    </header>
