<?php
use app\specialClasses\FormBuild as FormBuild;
/* <div class="row">  <div class="col-md-6 col-md-offset-3">
    <div class=""><div class="panel-heading">Sign up</div><div class="panel-body">
<form action="{{ path_for('****auth.signup')}}" method="post" autocomplete="off">{{ csrf_field() }}
<!-- form fields ***** --> <div class="form-group">  <label for="email">Email</label>
  <input type="email" name="email" id="email" placeholder="u@dom.com" class="form-control">
<div class="form-group"><label for="name">Name</label><input type="text"...>
<div class="form-group"><label for="password">Password</label> */

$form = FormBuild::instantiate('user'); // 'user' sets up: $args = $_POST['user'];
// Note: Controller should pass in $user and $values (array)

$formAtrrib = [
	'action' => '/user/create',
	'method' => 'post',
];
$formContent = $form->formTopDecl($formAtrrib, "Sign up");

$formContent .= $form->mkSimpTxtInpValDiv(['name' => 'username'], $user);

$fldAttribs = ['name' => 'email', 'placeholder' => "u@dom.com",]; // form field attributes
$formContent .= $form->mkTypeInpValDiv($fldAttribs, $user);

$fldAttribs = ['name' => 'fname', 'label' => 'First Name',];  // form field attributes
$formContent .= $form->mkSimpTxtInpValDiv($fldAttribs, $user);

$fldAttribs = ['name' => 'lname','label' => 'Last Name',];  // form field attributes
$formContent .= $form->mkSimpTxtInpValDiv($fldAttribs, $user);

$formContent .= $form->retInpTypeDiv("password", []); // note: don't save val

$fldAttribs = [
	'type' => 'password',
	'name' => 'confirm_password',
	'id' => 'confirm_password',
	'label' => 'Confirm Password',
	'labelFor' => 'Confirm Password',
];  // form field attributes

$formContent .= $form->retInpDiv($fldAttribs);  // note: don't save value if invalidated

$formContent .= $form->endForm(['submitTitle' =>'Create User']); // assumes </form</div</div
echo $formContent;
