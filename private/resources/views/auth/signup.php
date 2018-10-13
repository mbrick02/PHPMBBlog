<?php

// based on a twig form -- REMVE all "{% %}"
// ** Use FormBuilder class ********** to remake this
// noValue - attribs that have no val e.g. 'required'
// orig: { % xxx extends 'templates/xxapp.twigxxmain.php' -> main.php % }
use app\specialClasses;

$form = new FormBuild;

$formAtrrib = [
	'action' = DS . 'partials' . DS . 'public_header.php';
	'method' => 'post',
];
$formContent = $form->formTopDecl($formAtrrib);

$fldAttribs = ['name' => 'username',];  // form field attributes
$formContent .= retSimpTxtInpDiv($fldAttribs);
$fldAttribs = []; // clear field attributes assoc array

$fldAttribs = ['placeholder' => "u@dom.com",]; // form field attributes
$formContent .= retInpTypeDiv("email", $fldAttribs);
$fldAttribs = []; // clear field attributes assoc array

$fldAttribs = [
	'name' => 'fname',
	'label' => 'First Name',
];  // form field attributes
$formContent .= retSimpTxtInpDiv($fldAttribs);
$fldAttribs = []; // clear field attributes assoc array

$fldAttribs = [
	'name' => 'lname',
	'label' => 'Last Name',
];  // form field attributes
$formContent .= retSimpTxtInpDiv($fldAttribs);
$fldAttribs = []; // clear field attributes assoc array

$formContent .= retInpTypeDiv("password", $fldAttribs);
$fldAttribs = []; // clear field attributes assoc array

$fldAttribs = [
	'type' => 'password',
	'name' => 'confirm_password',
	'id' => 'confirm_password',
	'name' => 'confirm_password',
	'label' => 'Confirm Password',
	'labelFor' => 'Confirm Password',
];  // form field attributes
$formContent .= retInpDiv("confirm_password", $fldAttribs);
$fldAttribs = []; // clear field attributes assoc array

$formContent .= $form->endForm("Create User");
echo $formContent; // DEBUG** TEST
// $g_templateVars['form_content'] = $formContent;
