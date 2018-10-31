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

$form = FormBuild::instantiate('user'); // 'user' sets up: $args = $_POST['user'];

if ($user) {
	echo "in signup.php user: <br />";
	var_dump($user);
	echo "<br /> values array: "
	var_dump($values);
	die();
}

$formAtrrib = [
	'action' => '/user/create',
	'method' => 'post',
];
$formContent = $form->formTopDecl($formAtrrib, "Sign up");

$fldAttribs = ['name' => 'username',];  // form field attributes

$formContent .= $form->retSimpTxtInpDiv($fldAttribs);
$fldAttribs = []; // clear field attributes assoc array

$fldAttribs = ['placeholder' => "u@dom.com",]; // form field attributes
$formContent .= $form->retInpTypeDiv("email", $fldAttribs);
$fldAttribs = []; // clear field attributes assoc array

$fldAttribs = [
	'name' => 'fname',
	'label' => 'First Name',
];  // form field attributes
$formContent .= $form->retSimpTxtInpDiv($fldAttribs);
$fldAttribs = []; // clear field attributes assoc array

$fldAttribs = [
	'name' => 'lname',
	'label' => 'Last Name',
];  // form field attributes
$formContent .= $form->retSimpTxtInpDiv($fldAttribs);
$fldAttribs = []; // clear field attributes assoc array

$formContent .= $form->retInpTypeDiv("password", $fldAttribs);
$fldAttribs = []; // clear field attributes assoc array

$fldAttribs = [
	'type' => 'password',
	'name' => 'confirm_password',
	'id' => 'confirm_password',
	'label' => 'Confirm Password',
	'labelFor' => 'Confirm Password',
];  // form field attributes

$formContent .= $form->retInpDiv($fldAttribs);
$fldAttribs = []; // clear field attributes assoc array

$formContent .= $form->endForm(['submitTitle' =>'Create User']);
echo $formContent;
