<?php

use app\specialClasses\FormBuild as FormBuild;
/* <div class="row">  <div class="col-md-6 col-md-offset-3">
    <div class=""><div class="panel-heading">Sign up</div><div class="panel-body">
<!-- end form top ****** -->
<form action="{{ path_for('****auth.signup')}}" method="post" autocomplete="off">{{ csrf_field() }}
<!-- form fields ***** --> <div class="form-group">  <label for="email">Email</label>
  <input type="email" name="email" id="email" placeholder="u@dom.com" class="form-control">
<div class="form-group">  <label for="name">Name</label><input type="text"...>
<div class="form-group">  <label for="password">Password</label> */
$rightCol = FormBuild::retTag("div", ['class' => 'float-right my-lg-0']);
$rightCol .= FormBuild::retClosedTag("div", ['class' => 'my-lg-0'], "<h3>" . $userInfoRight . "</h3>");

$endTags = array('div', 'div');

$rightCol .=  FormBuild::endTags($endTags);

echo $rightCol;
