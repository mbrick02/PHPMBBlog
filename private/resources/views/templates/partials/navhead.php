<?php // called by include in main.php: $navMnuL, $pageUrls[] ?>
<div class="blog-masthead">
	<nav class="navbar navbar-default">
		<!--  navbar navbar-expand-lg navbar-light bg-light -->
	<div class="container container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<?php echo $hamburgBtn; ?>
			<a class="navbar-brand" href="<?php echo $pageUrls['products']; ?>">Brand</a>
		</div>
		<!-- Collect the nav links, forms, and oth content for toggling -->
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<?php echo $navMnuL; ?>
			<?php echo $navMnuR; ?>
		</div><!-- /.navbar-collapse -->
		</div> <!-- /.container-fluid -->
	</nav>
</div>
