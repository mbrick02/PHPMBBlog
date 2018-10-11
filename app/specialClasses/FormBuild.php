<?php

namespace app\specialClasses;

class FormBuild {
  // protected $protectedVar;
/*  Example of form: ********************
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <div class="">
      <div class="panel-heading">Sign up</div>
      <div class="panel-body">
<!-- end form top ****** -->

<!-- form declaration ******* -->
<form action="{{ path_for('****auth.signup')}}" method="post" autocomplete="off">
 {{ csrf_field() }}
<!-- form fields ***** -->
<div class="form-group">  <label for="email">Email</label>
  <input type="email" name="email" id="email" placeholder="u@dom.com" class="form-control">
</div>
<div class="form-group">  <label for="name">Name</label>
  <input type="text" name="name" id="name" class="form-control">
</div>
<div class="form-group">  <label for="password">Password</label>
  <input type="password" name="password" id="password" class="form-control">
</div>
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
    // DEL: $output .= "method=\"$assiVars['post']\" . $autoCompl . ">\n";

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

    if isset($assiVars['noValue']) {
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
    // Inputs: $assiVars['lblFor'] (and lbl, type, name, id, and class)

    $output = "<div class=\"form-group\"> \n";
    $output .= "<label for=\"{$assiVars['lblFor']}\">{$assiVars['lbl']}</label>\n";

    $inpFldVars = [];

    // set input field attribs - ignore label vars
    foreach ($variable as $key => $value) {
      if (($key != 'lblFor') && ($key != 'lbl')) {
        $inpFldVars[$key] = $assiVars[$key];
      }
    }

    $output .= $this->retInpFld($inpFldVars);
    $output .= "</div>";

    return $output;

  } // DEBUG**: else { "returnTxtField with no assignedVars"}

  public function retTxtAreaDiv($assiVars = []) {
    $output = "<div class=\"form-group\"> \n";
    $output .= $this->retClosedTag("textarea", $assiVars) . "\n";
    $output .= "</div>";
  }

  public function retTypeDiv($type, $assiVars = []) {
    $typeVars = $assiVars;
    $typeVars['type'] = $type;
    $typeVars['name'] = $type;
    $typeVars['id'] = $type;

    $output = "<div class=\"form-group\"> \n";
    $output .= $this->retInpFld($typeVars) . "\n";
    $output .= "</div>";
  }

  public function endForm ($submitTitle) {
    global $g_templateVars['submitTitle'] = $submitTitle;

    include TEMPLATE_PATH . DS . 'partials' . DS . 'form_bottom.php';
  }
}
