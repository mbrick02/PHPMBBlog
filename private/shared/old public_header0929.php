<!doctype html>

<html lang="en">
  <head>
    <title>MB Blog Page <?php if(isset($page_title)) { echo '- ' . h($page_title); } ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/public.css'); ?>" />
  </head>

  <body>

    <header>
      <h1>
        <a href="<?php echo url_for('/index.php'); ?>">
          <img class="mb-icon" src="<?php echo url_for('/images/blog_symbol.svg') ?>" /><br />
          MB Blog
        </a>
      </h1>
    </header>
