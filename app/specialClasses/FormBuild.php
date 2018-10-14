<?php
namespace app\specialClasses;
// include PRIVATE_PATH . DS . "classes" . DS . "token.class.php";
require_once APP_PATH . DS . 'specialClasses' . DS . "Token.php";
use Token as Token;

class FormBuild {
/*  Example of form: ********************
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <div class="">
      <div class="panel-heading">Sign up</div><div class="panel-body">
<!-- end form top ****** -->
<!-- form declaration ******* -->
<form action="{{ path_for('****auth.signup')}}" method="post" autocomplete="off">
 {{ csrf_field() }}
<!-- form fields ***** --> <div class="form-group">  <label for="email">Email</label>
  <input type="email" name="email" id="email" placeholder="u@dom.com" class="form-control">
<div class="form-group">  <label for="name">Name</label><input type="text"...>
<div class="form-group">  <label for="password">Password</label>  <input type="password" name="password"...>
"\n" for newline (Linux & Mac -- Win takes it okay)
*/
  public function formTopDecl($assiVars = []) {
    /* ****  Inputs:  $assiVars['action'] & ['csrf_field']
    Examp:
    <form action="{{ path_for('****auth.signup')}}"
        method="post" autocomplete="off">
       {{ csrf_field() }}
    **************** */
    // note space before autocomlete -- if ignored, no space at end of str
    // DEL: $autoCompl = isset($assiVars['autocomplete']) ? " autocomplete=\"" . $assiVars['autocomplete'] . "\"";
    $output = $this->retTag("form", $assiVars);
    // DEL: "<form action=\"$assiVars['action']\" ";
    // DEL: $output .= "method=\"$assiVars['method']\" . $autoCompl . ">\n";

    $token = Token::generate();
    $inputFldVars = [
            'type' => 'hidden',
            'name' => 'token',
            'value' => $token,
          ];

    // exampl: <input type="hidden" name="token"
    //        "value="<?php echo Token::generate(); ? > ">
    $inputFld = $this->retInputFld($inputFldVars);
  }

  public function retTag($tagType, $assiVars = []) {
    $class = "form-control";
    $output = "<". $tagType;
    foreach ($assiVars as $key => $value) {
      // noValue - attribs that have no val e.g. 'required'
      if ($key == 'noValue') { continue; }
      if ($key == 'class') { continue; }
      $output .= " " . $key . "=\"{$value}\"";
    }

    if (isset($assiVars['class'])) {
      $class = $class . " " . $assiVars['class'];
    }

    $output .= $class;

    if (isset($assiVars['noValue'])) {
      $output .= " " . $assiVars['noValue'];
    }

    $output .= ">";
  }

  public function retClosedTag($tagType, $assiVars = []) {
    $output = $this->retTag($tagType, $assiVars) . "\n";
    $output .= "</" . $tagType . ">\n";
  }

  public function retInpFld($assiVars = []) {
    // inputs = $assiVars['type'] (options: 'name', 'value', etc)
    // examp: <input type="hidden" name="token" value="<?php echo Token::generate(); ">
    $output = $this->retTag("input", $assiVars);
    return $output;
  }

  public function retInpDiv($assiVars = []) {
    // Inputs: $assiVars['labelFor'] (and labl, type, name, id, and class)

    $output = "<div class=\"form-group\"> \n";
    $output .= "<label for=\"{$assiVars['labelFor']}\">" . ucfirst($assiVars['label']) . "</label>\n";

    $inpFldVars = [];

    // set input field attribs - ignore label vars
    foreach ($variable as $key => $value) {
      if (($key != 'labelFor') && ($key != 'label')) {
        $inpFldVars[$key] = $assiVars[$key];
      }
    }

    $output .= $this->retInpFld($inpFldVars);
    $output .= "</div>";

    return $output;

  } // DEBUG**: else { "returnTxtField with no assignedVars"}

  public function retSimpTxtInpDiv($fldNameNLabel = []) {
/*   inputs: $fldNameNLabel['name'], (option ['label'])
*/
    $name = $fldNameNLabel['name'];
    $txtFldVars = [
      'type' => 'text',
      'name' => $name,
      'labelFor' => $name,
      'id' => $name,
    ];
    $txtFldVars['label'] = isset($fldNameNLabel['label']) ? $fldNameNLabel['label'] : ucfirst($name);
    // or PHP7 ?? null coalescing
    $output = $this->retInpDiv($txtFldVars);
  }

  public function retTxtAreaDiv($assiVars = []) {
    $output = "<div class=\"form-group\"> \n";
    $output .= $this->retClosedTag("textarea", $assiVars) . "\n";
    $output .= "</div>";
  }

  public function retInpTypeDiv($type, $assiVars = []) {  // type name and id are all same
    $typeVars = $assiVars;
    $typeVars['type'] = $type;
    $typeVars['name'] = $type;
    $typeVars['id'] = $type;

    $output = "<div class=\"form-group\"> \n";
    $output .= $this->retInpFld($typeVars) . "\n";
    $output .= "</div>";
  }

  public function endForm ($submitTitleAry = []) {
    extract($submitTitleAry);
    $submitTitle = $submitTitleAry['submitTitle'];

    include TEMPLATE_PATH . DS . 'partials' . DS . 'form_bottom.php';
  }
}
