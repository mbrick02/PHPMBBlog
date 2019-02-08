<?php
use app\specialClasses\FormBuild as FormBuild;
/* <div class="row">  <div class="col-md-6 col-md-offset-3">
    <div class=""><div class="panel-heading">Sign up</div><div class="panel-body">
<form action="{{ path_for('****auth.signup')}}" method="post" autocomplete="off">{{ csrf_field() }}
<!-- form fields ***** --> <div class="form-group">  <label for="email">Email</label>
  <input type="email" name="email" id="email" placeholder="u@dom.com" class="form-control">
<div class="form-group"><label for="name">Name</label><input type="text"...>
<div class="form-group"><label for="password">Password</label> */

$form = FormBuild::instantiate('login'); // 'login' sets up: $args = $_POST['login'];
// Note: Controller should pass in $user and $values (array)

$formAtrrib = [
	'action' => '/user/login',
	'method' => 'post',
	'mainDivClass' => 'col-md-12 float-left',
];
$formContent = $form->formTopDecl($formAtrrib); // , "Login"

$aryTagsAttrs[] = array('name' => 'usernameOREmail',
							'label' => 'Username or Email',
							'type' => 'text',
							'placeholder' => "uname_or_email@dom.com");

$aryTagsAttrs[] = array('type' => 'password');
$formContent .= $form->mkInpsValSec($aryTagsAttrs, $user);
// 2/7/19+ test above - this "worked"$formContent .= $form->mkSimpTxtInpValSec($aryTagsAttrs[0], $user); // ** 2/8/19 change to: $form->mkInpsValSec($aryTagsAttrs, $user);
// UPDATE above to: $formContent .= $form->retInpsValSec($aryFields, $user);
// $formContent .= $form->retInpTypeNLbl("password", []); // note: don't save val  // was retInpTypeDiv(...)

$formContent .= $form->endForm(['submitTitle' =>'Login']);
// ** already set by formTopDecl: $formContent = FormBuild::retClosedTag("div",
// ** already set by formTopDecl: 	 ['class' => 'col-md-6 col-md-offset-1 float-left'], $formContent);
echo $formContent;
