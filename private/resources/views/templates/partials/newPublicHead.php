<?php // $htmlTitle, $webTitle, $urlForIndex, $urlForMBBlogLogo, $locStylesheet, $localscripts ?>
  <title><?php echo $htmlTitle ?></title>
  <meta charset="utf-8">

  <link rel="stylesheet" <?php echo $bstrapCSSIntegStr ?> />
  <link rel="stylesheet" media="all" href="<?php echo $locStylesheet; ?>" />
  <script src="<?php echo $pageJquery; ?>"></script>
  <script src="<?php echo $pageBstrpJS; ?>"></script>

  <?php echo $localscripts; ?>
