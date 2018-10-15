<?php
namespace app\specialClasses;
// include PRIVATE_PATH . DS . "classes" . DS . "token.class.php";
require_once APP_PATH . DS . 'specialClasses' . DS . "Token.php";
use Token as Token;
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
class FormBuild {
  public function formTopDecl($assiVars = [], $panelHeading) {
    /* ****  Inputs:  $assiVars['action'] & ['csrf_field']
    Examp:<form action="{{ path_for('****auth.signup')}}" method="post" autocomplete="off">
       {{ csrf_field() }}
    **************** */
    // note space before autocomlete but no space at end of str
    // DEL: $autoCompl = isset($assiVars['autocomplete']) ? " autocomplete=\"" . $assiVars['autocomplete'] . "\"";
    $output = $this->retTag("div", ['class' => 'row']);
    $output .= $this->retTag("div", ['class' => 'col-md-6 col-md-offset-3']);
    $output .= $this->retTag("div");
    $output .= $this->retClosedTag("div", ['class' => 'panel-heading'], $panelHeading);
    $output .= $this->retTag("div", ['class' => 'panel-body']);
    $output .= $this->retTag("form", $assiVars);

    $token = Token::generate();
    $inputFldVars = [
            'type' => 'hidden',
            'name' => 'token',
            'value' => $token,
          ];

    // examp: <input type="hidden" name="token" "value="<?php echo Token::generate();>">
    $output .= $this->retInpFld($inputFldVars);

    return $output;
  }

  public function retTag($tagType, $assiVars = []) {

    $output = "<". $tagType;
    foreach ($assiVars as $key => $value) {
      // noValue - attribs that have no val e.g. 'required'
      if ($key == 'noValue') { continue; }
      if ($key == 'class') { continue; }
      $output .= " " . $key . "=\"{$value}\"";
    }

    $class = " class =\"";

    $class .= isset($assiVars['class']) ? $assiVars['class'] . " " : "";
    $class .= "form-control" .  "\"";

    $output .= $class;

    if (isset($assiVars['noValue'])) {
      $output .= " " . $assiVars['noValue'];
    }

    $output .= ">\n";

    return $output;
  }

  public function endTag($tagType) {
    return "</" . $tagType . ">\n";
  }

  public function endTags($aryTags){
    $output = "";
    foreach ($aryTags as $tag) {
      $output .= $this->endTag($tag);
    }
    return $output;
  }

  public function retClosedTag($tagType, $assiVars = [], $tagContent="") {
    $output = $this->retTag($tagType, $assiVars);
    $output .= $tagContent;
    $output .= $this->endTag($tagType);

    return $output;
  }

  public function retInpFld($assiVars = []) {
    // inputs = $assiVars['type'] (options: 'name', 'value', etc)
    // examp: <input type="hidden" name="token" value="<?php echo Token::generate(); ">
    $output = $this->retTag("input", $assiVars);
    return $output;
  }

  public function retInpDiv($assiVars = []) {
    if (is_null($assiVars) || (!is_array($assiVars))) { // || !array_key_exists('labelFor', $assiVars))
      var_dump($assiVars);
      die();
    }
    // Inputs: $assiVars['labelFor'] (and labl, type, name, id, and class)
    $output = "<div class=\"form-group\"> \n";
    $output .= "<label for=\"{$assiVars['labelFor']}\">" . ucfirst($assiVars['label']) . "</label>\n";

    $inpFldVars = [];

    // set input field attribs - ignore label vars
    foreach ($assiVars as $key => $value) {
      if (($key != 'labelFor') && ($key != 'label')) {
        $inpFldVars[$key] = $value;
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
      'label' => $name,
      'id' => $name,
    ];
    $txtFldVars['label'] = isset($fldNameNLabel['label']) ? $fldNameNLabel['label'] : ucfirst($name);
    // or PHP7 ?? null coalescing
    $output = $this->retInpDiv($txtFldVars);

    return $output;
  }

  public function retTxtAreaDiv($assiVars = []) {
    $output = "<div class=\"form-group\"> \n";
    $output .= $this->retClosedTag("textarea", $assiVars) . "\n";
    $output .= "</div>";

    return $output;
  }

  public function retInpTypeDiv($type, $assiVars = []) {  // type name and id are all same
    $typeVars = $assiVars;
    $typeVars['type'] = $type;
    $typeVars['name'] = $type;
    $typeVars['id'] = $type;
    $typeVars['label'] = $type;
    $typeVars['labelFor'] = $type;

    return $this->retInpDiv($typeVars); //  . "\n"
  }

  public function endForm ($submitTitleAry = []) {
    extract($submitTitleAry);
    $submitTitle = $submitTitleAry['submitTitle'];

    $buttonAttribs = [
      'type' => 'submit',
      'class' => 'btn btn-default'
    ];

    $output = $this->retClosedTag("button", $buttonAttribs, $submitTitle);

    $endTags = array('form', 'div', 'div', 'div', 'div');

    $output .= $this->endTags($endTags);
    return $output;

/*  <button type="submit" class="btn btn-default"><?php echo $submitTitle ?></button>
</form></div></div></div></div>   ***********************/
    // DEL (old ver): include TEMPLATE_PATH . DS . 'partials' . DS . 'form_bottom.php';
  }
}
