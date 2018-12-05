<?php
use app\specialClasses\FormBuild as FormBuild;
/* <div class="row">  <div class="col-md-6 col-md-offset-3">
    <div class=""><div class="panel-heading">Sign up</div><div class="panel-body">
<form action="{{ path_for('****auth.signup')}}" method="post" autocomplete="off">{{ csrf_field() }}
<!-- form fields ***** --> <div class="form-group">  <label for="email">Email</label>
  <input type="email" name="email" id="email" placeholder="u@dom.com" class="form-control">
<div class="form-group"><label for="name">Name</label><input type="text"...>
<div class="form-group"><label for="password">Password</label> */

$form = FormBuild::instantiate('login'); // 'user' sets up: $args = $_POST['user'];
// Note: Controller should pass in $user and $values (array)

$formAtrrib = [
	'action' => '/user/login',
	'method' => 'post',
	'mainDivClass' => 'col-md-12 float-left',
];
$formContent = $form->formTopDecl($formAtrrib, "Login");

$formContent .= $form->mkSimpTxtInpValDiv([
		'name' => 'usernameOREmail',
		'placeholder' => "uname_or_u@dom.com"], $user);

$formContent .= $form->retInpTypeDiv("password", []); // note: don't save val

$formContent .= $form->endForm(['submitTitle' =>'Login']);
// ** already set by formTopDecl: $formContent = FormBuild::retClosedTag("div",
// ** already set by formTopDecl: 	 ['class' => 'col-md-6 col-md-offset-1 float-left'], $formContent);
echo $formContent;
