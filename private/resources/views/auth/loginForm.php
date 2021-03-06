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
];

// old: $formContent = $form->formTopDivTkn($formAtrrib,"",['class'=>'panel-body','id'=>'login-content']);
$formContent = $form->mkFormTopTkn($formAtrrib);

$aryTagsAttrs[] = array('name' => 'usernameOREmail',
							'label' => 'Username or Email',
							'type' => 'text',
							'placeholder' => "uname_or_email@dom.com");

$aryTagsAttrs[] = array('type' => 'password');
// debug 2/10/19 take out to test mkInpsValSec below & die():
$formContent .= $form->mkInpsValSec($aryTagsAttrs, $user);

$aryTagsAttrs = []; // empty/reset array
/*
if ($key == 'enclLblNInp') continue; // array of Label & Input enclosing tag (eg. div)
if ($key == 'enclInp') continue;
*/
$aryTagsAttrs[] = array('type' => 'submit', 'name' => 'Login',
			'value' => 'Login', 'class' => 'submitbtn'); // add submit button
$aryTagsAttrs[] = array('type'=>'checkbox','name'=>'remember_me','id'=>'remember_me',
				'class'=>'checkbox','label'=>'Remember Me','noValue'=>'checked', 'lblClass'=>'checkboxLbl',
				'value'=>true, 'enclLblNInp' => ['tag'=>'div','class'=>'lblNcheckbox','id'=>'remember_me',],
				'enclInp' => ['tag'=>'span', 'class'=>'checkbox']); // label & checkbox (enclosed in span) endlosed in div
$noModel = '';
// 2/10/19
$formPart = array("name" => "fieldset", "id" => "actions", "class" => "fieldset", );
// $form->mkInpsValSec($origfldAttrSets, $model, $secTyp = "fieldset", $formPart)
$lblNID = false;
/* ($origfldAttrSets, $model = "", $secTyp = "fieldset",
	$formPart = array("name" => "fieldset", "id" => "inputs", "class" => "fieldset", ),
	$assumLblNID = true)
	 */
$formContent .= $form->mkInpsValSec($aryTagsAttrs, $noModel, "fieldset", $formPart, $lblNID); // create submit checkbox fieldset

// $submitTagAttrs[] = array('type' => 'submit', value='Login' 'class' => 'btn btn-default')
$formContent .= $form->endtags(array('form'));
// above was: endForm(['submitTitle' =>'Login']); (and assumed 2 divs)
// ** already set by formTopDivTkn: $formContent = FormBuild::retClosedTag("div",
// ** already set by formTopDivTkn: 	 ['class' => 'col-md-6 col-md-offset-1 float-left'], $formContent);
echo $formContent;
