<?php
// echo $publicHeader; // Logo, Page title, errors or other messages via partials/public_header
 ?>

 <div class="blog-masthead">
   <nav class="navbar navbar-default">
     <!--  navbar navbar-expand-lg navbar-light bg-light -->
     <!-- Brand and toggle get grouped for better mobile display -->
     <div class="container">
         <div class="navbar-header">
             <button type="button" class="navbar-toggle" data-toggle="collapse"
              data-target="#bs-example-navbar-collapse-1">
                 <span class="sr-only">Toggle navigation</span>
                 <span class="icon-bar"></span>
                 <span class="icon-bar"></span>
                 <span class="icon-bar"></span>
             </button>
             <a class="navbar-brand" href="#">Brand</a>
         </div>
         <!-- Collect the nav links, forms, and other content for toggling -->
         <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
             <ul class="nav navbar-nav">
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
 <!-- ************  END NAV HEAD experi 10/16/18 ******************** -->
