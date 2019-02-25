<?php
// echo $publicHeader; // currently in newMain: Logo, Page title, errs or oth msgs - partials/public_header
$indnt = "    ";
$indnt3 = $indnt . $indnt . $indnt;
$indnt5 = $indnt3 . $indnt . $indnt;
// 3-line "hamburger" menu button for mobile device menu
$hamburgBtn = $indnt3 . '<button type="button" class="navbar-toggle" data-toggle="collapse"' . "\n";
$hamburgBtn .= $indnt3 . $indnt . 'data-target="#bs-example-navbar-collapse-1">' . "\n";
$hamburgBtn .= $indnt5 . '<span class="sr-only">Toggle navigation</span>' . "\n";
$hamburgBtn .= $indnt5 . '<span class="icon-bar"></span>' . "\n";
$hamburgBtn .= $indnt5 . '<span class="icon-bar"></span>' . "\n";
$hamburgBtn .= $indnt5 . '<span class="icon-bar"></span>' . "\n";
$hamburgBtn .= $indnt3 . $indnt . '</button>' . "\n";

$brand = $indnt3 . $indnt . '<a class="navbar-brand" href="#">Brand</a>' . "\n";

$leftTpMenu = ""; // 02/24/19 put in lines below
 ?>

 <div class="blog-masthead">
   <nav class="navbar navbar-default">
     <!--  navbar navbar-expand-lg navbar-light bg-light -->
     <!-- Brand and toggle get grouped for better mobile display -->
     <div class="container">
         <div class="navbar-header"><!-- This makes hamburger icon for small screens -->
<?php echo $hamburgBtn; ?>
<?php echo $brand; ?>

         </div>
         <!-- Collect the nav links, forms, and other content for toggling -->
         <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
             <ul class="nav navbar-nav"><!-- left side menu bar -->
                 <li><a href="#">Home</a></li>
                 <li><a href="#">Profile</a></li>
                 <li class="dropdown">
                     <a href="#" data-toggle="dropdown" class="dropdown-toggle">Messages <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                         <li><a href="#">Inbox</a></li> <!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
                         <li><a href="#">Drafts</a></li>
                         <li><a href="#">Sent Items</a></li>
                         <li class="divider"></li>
                         <li><a href="#">Trash</a></li>
                     </ul>
                 </li>
             </ul>
             <ul class="nav navbar-nav navbar-right"> <!-- right side menu -->
<!-- on-page (rather than live demo) shows: ul class="nav pull-right" -->
                 <li class="dropdown">
                     <a href="#" data-toggle="dropdown" class="dropdown-toggle">Admin <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                         <li><a href="#">Action</a></li>
                         <li><a href="#">Another action</a></li>
                         <li class="divider"></li>
                         <li><a href="#">Settings</a></li>
                     </ul>
                 </li>
             </ul>
         </div><!-- /.navbar-collapse -->
     </div>
   </nav>
 </div><!-- masthead -->
