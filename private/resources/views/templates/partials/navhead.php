<?php
// called by include in main.php
// vars (set in ): $pageUrls['products'], $pageUrls['curURL'] == '/',  $pageUrls['curURL'] == '/about'

?>

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
			<a class="navbar-brand" href="<?php echo $pageUrls['products']; ?>">Brand</a>
		</div>
		<!-- Collect the nav links, forms, and oth content for toggling -->
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="nav navbar-nav">
				<li class="<?php echo ($pageUrls['curURL'] == '/') ? 'active' : '';  ?>"><a
						href="/">Home</a></li>
				<li><a class="nav-link nav-item<?php echo ($pageUrls['curURL'] == '/about') ? ' active' : '';  ?>"
					  href="#">About</a></li>
			</ul>
