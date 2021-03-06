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
  private static $_nameAry = ""; // used in retTag() for form value array
  private static $_useDBVals; // set in __construct **Note: 2/11/19 Currently NOT USED

  private function __construct($nameAry = "", $useDBVals = false) {
    static::$_nameAry = $nameAry; // reset to empty
    static::$_useDBVals = $useDBVals;  // fill form with any DB vals? (Currently NOT used)
    // TODO: set vals from (if)model:     $values = $model->getCols();
  }

  public static function instantiate($nameAry, $useDBVals = false) {
    $object = new static($nameAry, $useDBVals);
    return $object;
  }

  public function mkFormTopTkn($frmAttr){
    /* Inputs: $frmAttr['action'], $frmAttr['method']
        Outputs:  */
    $formVars = [
      'action' => $frmAttr['action'],
      'method' => $frmAttr['method'],
    ];


    $output = self::retTag("form", $formVars);

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

  public function formTopDivTkn($frmAttr, $frmDivHeading = "", $frmBodyAttr = ['class'=> 'panel-body']) {
    /* ****  Inputs:  form action, method ($assi_Vars['action'],
    Examp:<form action="{{ path_for('**auth.signup')}}" method="post" autocomplete="off"> & {csrf_fld()/Token}
    ***TOO COMPLICATED AND NOT INTUITIVE used only in views/auth/signup.php ONLY********** */
    $formVars = [
      'action' => $frmAttr['action'],
      'method' => $frmAttr['method'],
    ];

    if (isset($frmAttr['mainDivClass'])) {
      $mainDivClass = $frmAttr['mainDivClass'];
    } else { // default
      $mainDivClass = 'col-md-6 col-md-offset-1 float-left';
    }
    $output = self::retTag("div", ['class' => $mainDivClass]);

    if (!empty($frmDivHeading)){ // create panel title and heading if exist
      $output .= self::retClosedTag("div", ['class' => 'panel-heading'], "<h2>" . $frmDivHeading . "</h2>");
    }


    $output .= self::retTag("div", $frmBodyAttr);
    $output .= self::retTag("form", $formVars);

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

  public static function retTag($tagType, $assiVars = []) {
    /* input: tag-type and assoc array of attribs and their vals
      output: <tagtype attr1="attr1Val", attr2...>  */
    $output = "<". $tagType;
    $assignVars = $assiVars;

    foreach ($assiVars as $key => &$value) {
      // noValue - attribs that have no val e.g. 'required'
      if ($key == 'noValue') { continue; }
      if ($key == 'labelFor') { continue; }
      if ($key == 'label') { continue; }
      //if ($key == 'class') { continue; }  // **? why did I skip class???
      if ($key == 'name' && (!empty(static::$_nameAry))) {
        $value = static::$_nameAry . "[{$value}]";
      }
      $output .= " " . $key . "=\"{$value}\"";
    }
    // $class = " class =\""; // **? why did I skip class???
    //$class .= isset($assiVars['class']) ? $assiVars['class'] . "\"" : "\"";  // **? why did I skip class???
    // $output .= $class;  // **? why did I skip class???

    if (isset($assiVars['noValue'])) {
      $output .= " " . $assiVars['noValue'];
    }
    $output .= ">\n";

    return $output;
  }

  public static function endTag($tagType) {
    return "</" . $tagType . ">\n";
  }

  public static function endTags($aryTags){
    /*
    input: ending tag names
    output: </tag1></tag2....
    */
    $output = "";
    foreach ($aryTags as $tag) {
      $output .= self::endTag($tag);
    }
    return $output;
  }

  public static function retClosedTag($tagType, $assiVars = [], $tagContent="") {
    /*
    input: enclosed tag type, attrib assoc ary w/ vals, content for tag
    output: <tag attr1="attr1Val" attr2...>tagcontent</tag> (tag encloses 'payload' of $tagContent)
    */

    $output = self::retTag($tagType, $assiVars);
    $output .= $tagContent;
    $output .= "\n" . "    " .self::endTag($tagType);

    return $output;
  }

  public function retInpFldNLbl($assiVars = []) {
    // inputs = $assiVars['type'] (options: 'name', 'value', etc. w/option for label and input encl tag)
    // examp: <div><input type="hidden" name="token" value="<?php echo Token::generate(); "></div>
    $output = "";
    $label = "";
    $indent = "    ";
    if (isset($assiVars['label'])){
      if (!isset($assiVars['labelFor'])) {
        $assiVars['labelFor'] = $assiVars['name'];
      }
      if (!empty(static::$_nameAry)) {
        $assiVars['labelFor'] = static::$_nameAry . "[{$assiVars['name']}]";
      }
      // **** 2/14/19 missing:<label class="checkboxLbl"
      $lblClass = isset($assiVars['lblClass']) ? " class=\"" . $assiVars['lblClass'] . "\"" : '';
      $label = "<label" . $lblClass. " for=\"{$assiVars['labelFor']}\">" . ucfirst($assiVars['label']) . ":</label>\n";
    }


    $inpVars = [];
    foreach ($assiVars as $key => $value){
      if ($key == 'enclLblNInp') continue; // array of Label & Input enclosing tag (eg. div)
      if ($key == 'enclInp') continue; // array of Input enclosing tag (eg. <span>)
      if ($key == 'lblClass') continue;  // skip label class
      $inpVars[$key] = $value;
    }

    if (!isset($inpVars['class'])) {
      $inpVars['class'] = "form-control"; // default
    }/* elseif (!strpos($inpVars['class'], 'form-control')) {  $inpVars['class'] .= " form-control";  } */ // always form-control?

    $inpTag = self::retTag("input", $inpVars);

    if (isset($assiVars['enclInp'])) {
      $tag = $assiVars['enclInp']['tag'];
      $tagAttribs = array_slice($assiVars['enclInp'],1); // Note: 1st element must be 'tag'
      $content = $indent . $indent . $inpTag;
      $inpTag = $indent . self::retClosedTag($tag, $tagAttribs, $content);
    } else {
      $inpTag = $indent . $inpTag;
    }

    if (isset($assiVars['enclLblNInp'])) {
      $tag = $assiVars['enclLblNInp']['tag'];
      $tagAttribs = array_slice($assiVars['enclLblNInp'],1); // Note: 1st element must be 'tag'
      $content = $indent . $indent . $label . "\n" . $indent . $indent . $inpTag;
      $output = self::retClosedTag($tag, $tagAttribs, $content);
    } else {
      $output = $indent . $label . "\n" . $indent . $inpTag;
    }

    return $output;
  }

  public function retInpFld($assiVars = []) {
    // inputs = $assiVars['type'] (options: 'name', 'value', etc)
    // examp: <input type="hidden" name="token" value="<?php echo Token::generate(); ">
    $inpVars = $assiVars;
    if (!isset($inpVars['class'])) {
      $inpVars['class'] = "form-control";
    } elseif (!in_str($inpVars['class'], 'form-control')) {
      $inpVars['class'] .= " form-control";
    }

    $output = self::retTag("input", $inpVars);
    return $output;
  }

  public function xdelretInpFldst($formPart = array("name" => "fieldset", "id" => "inputs", "class" => "fieldset", ),
                                    $assiVars = []) {
        // based on retInpDiv
        // Inputs: $formPart (e.g. ("name" => "fieldset")),
        //        (ONE array of tag attributes) $assiVars['labelFor'] (and labl, type, name, id, and class)
        //        $mode (e.g. $user)
        // returns: input field with label inside a section of $formPart['name'] (default 'fieldset')

        $formPartStr = "<" . $formPart['name'];
        $formPartStr .= (!empty($formPart['id'])) ? " id='" . $formPart['id'] . "'": '';
        $formPartStr .= ((!empty($formPart['class'])) ? " class='" . $formPart['class'] . "'": '') . ">";
        // ?? should above be foreach other than name ???
        $output = "$formPartStr \n"; // e.g. fieldset id="inputs"
        $output .= "   <label for=\"{$assiVars['labelFor']}\">" . ucfirst($assiVars['label']) . ":</label>\n";

        $inpFldVars = [];

        // set input field attribs - ignore label vars
        foreach ($assiVars as $key => $value) {
            $inpFldVars[$key] = $value;
        }

        $output .= "   " . $this->retInpFld($inpFldVars);
        $output .= "</" . $formPart['name'] . ">\n";
        return $output;
    }

  public function xdelNOTUSEDretInpsFldst($formPart = array("name" => "fieldset", "id" => "inputs", "class" => "fieldset", ),
                                  $assiVarsSet = []) {
      // ***BUG currently have foreach that needs $values which should be passed in by caller into $assiVarsSet
      // based on (supersedes) retInpFldst with multiple inputs
      // called by (design): retInpsSec (from ?retInpsSec from mkInpsValSec)
      // Inputs: $formPart (e.g. ("name" => "fieldset")),
      //        $assiVarsSet array w/item['labelFor'] (and labl, type, name, id, and class)
      //        $mode (e.g. $user)
      // returns: input field with label inside a Section of default ('fieldset') or give group class

      $formPartStr = "<" . $formPart['name'];
      $formPartStr .= (!empty($formPart['id'])) ? " id='" . $formPart['id'] . "'": '';
      $formPartStr .= ((!empty($formPart['class'])) ? " class='" . $formPart['class'] . "'": '') . ">";
      // ?? should above be foreach other than name ???
      $output = "$formPartStr \n"; // e.g. fieldset id="inputs"


      /*  *** 2/8/19 all but top and bottom handled by mkInpsValSec ????????????????????
      foreach ($assiVarsSet as $assiVars) {
        $newFldVars = $assiVars;
        if ($assiVars['type'] == 'text'){  // create standard text input field
          $fldName = $assiVars['name'];
          $newFldVars = [
            'name' => (isset($assiVars['name']) ? $assiVars['name'] : $fldName),
            'labelFor' => (isset($assiVars['labelFor']) ? $assiVars['labelFor'] : $fldName),
            'label' => (isset($assiVars['label']) ? $assiVars['label'] : $fldName),
            'id' => (isset($assiVars['id']) ? $assiVars['id'] : $fldName),
          ];

          if (isset($assiVars['value']) && (!empty($values[$field]))) {  // val from caller (e.g. retInpsSec() from mkInpsValSec($aryFldSets, $model[->getCols]))
            $newFldVars['value'] = $assiVars['value'];
          }
        } elseif (!isset($assiVars['name']) && (isset($assiVars['type'])) ) {
          $this->retInpTypeNLbl($assiVars['type'], []);
        } else { // DEBUG ******* (REMOVE) 2/8/19
          echo "Prog ERROR: HTML form tag in F_Build:retInpsFldst NOT text or type";
          die();
        }

        $output .= "   <label for=\"{$assiVars['labelFor']}\">" . ucfirst($assiVars['label']) . ":</label>\n";

        $inpFldVars = [];

        // set input field attribs - ignore label vars
        foreach ($assiVars as $key => $value) {
            $inpFldVars[$key] = $value;
        }

        $output .= "   " . $this->retInpFld($inpFldVars) . "\n";
      } // end foreach($assiVarsSet)  ******
      */
      $output .= "</" . $formPart['name'] . ">\n";
      return $output;
    }

  public function retInpDiv($assiVars = [], $grpCls = "form-group") {
    // Debug prob 10/2018 commented out 1/2019
    // if (is_null($assiVars) || (!is_array($assiVars))) { // || !array_key_exists('labelFor', $assiVars))
    //   echo "debug 2018 apparently assiVar null in retInpDiv hasnt happened yet...<br />";
    //   var_dump($assiVars);
    //   die();
    // }

    // Inputs: $assiVars['labelFor'] (and labl, type, name, id, and class)
    // returns: input field with label inside a div of default or give group class
    $output = "<div class=\"$grpCls\"> \n";
    $output .= "<label for=\"{$assiVars['labelFor']}\">" . ucfirst($assiVars['label']) . ":</label>\n";

    $inpFldVars = [];

    // set input field attribs - ignore label vars
    foreach ($assiVars as $key => $value) {
        $inpFldVars[$key] = $value;
    }

    $output .= $this->retInpFld($inpFldVars);
    $output .= "</div>\n";

    return $output;

  } // DEBUG**: else { "returnTxtField with no assignedVars"}

  public function xdelNOTUSEDretInpsSec($fldsNameNLabel = [], $secType = "fieldset") {
    /*   based on (to supercede) retSimpTxtInpSec but inputs multiple Input fields
      inputs: $fldNameNLabel['name'], (option ['label'])
      return: form section such as "fieldset" with input field(s) */
      /******************based on retSimpTextInpSec below************debug/rewrite
      $fldAttribs = $origfldAttr; // e.g. ['name' => $field, ];
      $field = $fldAttribs['name'];
      $values = $model->getCols();  // e.g. $user->getCols for class column vals

      if (isset($values[$field]) && (!empty($values[$field]))) {
          // use model val if exists
          $fldAttribs['value'] = $values[$field];
      }
      return $this->retSimpTxtInpSec($fldAttribs, $secTyp);

      8888888888888888888888888**********************************
    $name = $fldNameNLabel['name'];
    $txtFldVars = [
      'type' => 'text',
      'name' => $name,
      'labelFor' => $name,
      'label' => $name,
      'id' => $name,
    ];

    $txtFldVars = array_replace($txtFldVars, $fldNameNLabel); // add poss vals like 'value' or replace 'label'
    $txtFldVars['label'] = isset($fldNameNLabel['label']) ? $fldNameNLabel['label'] : ucfirst($name);

    // retInpsFldst($formPart = array("name" => "fieldset", "id" => "inputs",
    // "class" => "fieldset", ), $assiVars = [])
    $fieldSec = array("name" => $secType, "id" => "inputs", "class" => "fieldset", );
    $output = $this->retInpsFldst($fieldSec, $txtFldVars); // TODO make $txtFldVars an ARRAY
    */
    return $output;
  }

  public function xdelretSimpTxtInpSec($fldNameNLabel = [], $secType = "fieldset") {
    /*   based on retSimpTxtInpDiv
      inputs: $fldNameNLabel['name'], (option ['label'])
      return: (return Simple Text Input in Section) form sect such as "fieldset" ONLY 1 input field */

    $name = $fldNameNLabel['name'];
    $txtFldVars = [
      'type' => 'text',
      'name' => $name,
      'labelFor' => $name,
      'label' => $name,
      'id' => $name,
    ];
    $txtFldVars = array_replace($txtFldVars, $fldNameNLabel); // add poss vals like 'value' or replace 'label'
    $txtFldVars['label'] = isset($fldNameNLabel['label']) ? $fldNameNLabel['label'] : ucfirst($name);

    // retInpsFldst($formPart = array("name" => "fieldset", "id" => "inputs",
    // "class" => "fieldset", ), $assiVars = [])
    $fieldSec = array("name" => $secType, "id" => "inputs", "class" => "fieldset", );
    $output = $this->retInpFldst($fieldSec, $txtFldVars); // TODO make $txtFldVars an ARRAY in retInpsFldst

    return $output;
  }

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
    $txtFldVars = array_replace($txtFldVars, $fldNameNLabel); // add poss vals like 'value' or replace 'label'
    $txtFldVars['label'] = isset($fldNameNLabel['label']) ? $fldNameNLabel['label'] : ucfirst($name);
    // or PHP7 ?? null coalescing
    $output = $this->retInpDiv($txtFldVars);

    return $output;
  }

  public function retTxtAreaDiv($assiVars = []) {
    $output = "<div class=\"form-group\"> \n";
    $output .= self::retClosedTag("textarea", $assiVars) . "\n";
    $output .= "</div>";

    return $output;
  }

  public function retInpTypeNLbl($type, $assiVars = []) {  // type name and id are all same
    $typeVars = $assiVars;
    $typeVars['type'] = $type;
    $typeVars['name'] = $type;
    $typeVars['id'] = $type;
    $typeVars['label'] = $type;
    $typeVars['labelFor'] = $type;
    // 11/18 currently NO NEED for $assiVars, but maybe future...

    return $this->retInpFldNLbl($typeVars); //  . "\n"
  }

  public function retInpTypeDiv($type, $assiVars = []) {  // type name and id are all same
    $typeVars = $assiVars;
    $typeVars['type'] = $type;
    $typeVars['name'] = $type;
    $typeVars['id'] = $type;
    $typeVars['label'] = $type;
    $typeVars['labelFor'] = $type;
    // 11/18 currently NO NEED for $assiVars, but maybe future...

    return $this->retInpDiv($typeVars); //  . "\n"
  }

  public function endForm($submitTitleAry = [], $endTags = array('form', 'div', 'div')) {
    // input: ary submitTitle btn attribs, ary tags to end form; output: end of form
    $buttonAttribs = [
      'type' => 'submit',
      'class' => 'btn btn-default'
    ];

    extract($submitTitleAry); // eg. ['submitTitle' =>'Creat usr'] => $submitTitle = 'Creat usr'
    // TOO CUTE?: probably better - just pass in var $submitTitle but... future use?
    //    e.g. could pass in $buttonAttribs and overwrite (default flag EXTR_OVERWRITE)
    // DELETE: DEBUG **$submitTitle = $submitTitleAry['submitTitle'];
    $output = self::retClosedTag("button", $buttonAttribs, $submitTitle);
    $output .= $this->endTags($endTags);
    return $output;

    /* examp: <button type="submit" class="btn btn-default"><?php echo $submitTitle ?></button>
      </form></div></div></div></div>   ***********************/
    // DEL (old ver): include TEMPLATE_PATH . DS . 'partials' . DS . 'form_bottom.php';
  }

  private function mkAssiVarsFromAttrSets($origfldAttrSets, $values = "", $assumLblNID = true) {
    /* loop thru sets of field attributes and output label and input field for each
      input: original sets of field attributes per each input tag, values passed in from db for fields
      output: labels and input fields with attributes via retInpFldNLbl */
    $output = "";
    foreach ($origfldAttrSets as $assiVars) {
      $newAssiVars = $assiVars;
      // 'type' that defines name (and field other than input) like password ??
      if ((isset($assiVars['type'])) && (!isset($assiVars['name']))) {
        $newAssiVars['name'] = $assiVars['type'];
      }

      // defaults for most inputs attribs unless otherwise set
      if((!empty($newAssiVars['name'])) && (isset($newAssiVars['name'])) && $assumLblNID) {  // should always be true
        $newAssiVars['labelFor'] = $newAssiVars['name'];
        $newAssiVars['label'] = $newAssiVars['name'];
        $newAssiVars['id'] = $newAssiVars['name'];
      }

      // set or RESET input field attribs to old values
      foreach ($assiVars as $key => $value) {
          // ***2/14/19 ?test for enclosing tag(s)? span tags?
          $newAssiVars[$key] = $value;
      }
      if ((!empty($field)) && (isset($values[$field]) && (!empty($values[$field])))) { // type text
          // use model val if exists
          $newAssiVars['value'] = $values[$field];
      }

      $output .= $this->retInpFldNLbl($newAssiVars);
    }  // end foreach ($origfldAttrSets as $assiVars)
    return $output;
  }

  public function mkInpsValSec($origfldAttrSets, $model = "", $secTyp = "fieldset",
    $formPart = array("name" => "fieldset", "id" => "inputs", "class" => "fieldset", ),
    $assumLblNID = true) {
    /* based on mkSimpTxtInpValSec; called by view->form
    // create input text type w/Value check: <input type="text"...>
    // Note: 1 to many input fields can be in $origfldAttrSets */
    if (!empty($model)){
      $values = $model->getCols();  // e.g. $user->getCols for class column vals
    } else { $values = "";}

    $formPartStr = "<" . $formPart['name'];
    $formPartStr .= (!empty($formPart['id'])) ? " id='" . $formPart['id'] . "'": '';
    $formPartStr .= (!empty($formPart['class']) ? " class='" . $formPart['class'] . "'": '') . ">";
    // ?? should above be foreach other than name ???
    $output = "$formPartStr \n"; // e.g. fieldset id="inputs"

    $output .= $this->mkAssiVarsFromAttrSets($origfldAttrSets, $values, $assumLblNID);


    $output .= "</" . $formPart['name'] . ">\n";
    return $output;
  }

  public function xdelNotUsedmkSimpTxtInpValSec($origfldAttr, $model, $secTyp = "fieldset") {
    /* 2/9/19 based on and to supercede: mkSimpTxtInpValSec TO BE superceded by mkInpsValSec
    sets val and creates input text type w/Value (e.g. <input type="text"...>)
    inputs: field attributes from view->form
    output: Section/fieldset containing input field w/val  via retSimpTxtInpSec (or Should: mkTypeInpValSec)
    // Note: this ONLY makes 1 text input field
    */
    $fldAttribs = $origfldAttr; // e.g. ['name' => $field, ];
    $field = $fldAttribs['name'];
    $values = $model->getCols();  // e.g. $user->getCols for class column vals

    if (isset($values[$field]) && (!empty($values[$field]))) {
        // use model val if exists
        $fldAttribs['value'] = $values[$field];
    }
    return $this->retSimpTxtInpSec($fldAttribs, $secTyp); // sect only 1 TEXT input (more/diff use retInpsSec)
  }

  public function mkSimpTxtInpValDiv($origfldAttr, $model) {
    /*
    // sets val and creates input text type w/Value (e.g. <input type="text"...>)
    inputs: field attributes from view->form
    output: a div containing input field w/val  via retSimpTxtInpDiv
    */
    $fldAttribs = $origfldAttr; // e.g. ['name' => $field, ];
    $field = $fldAttribs['name'];
    $values = $model->getCols();  // e.g. $user->getCols for class column vals

    if (isset($values[$field]) && (!empty($values[$field]))) {
        // use model val if exists
        $fldAttribs['value'] = $values[$field];
    }
    return $this->retSimpTxtInpDiv($fldAttribs);
  }

  public function mkTypeInpValDiv($origfldAttr, $model) {
    /*
    create input special type w/Value check - e.g. <input type="email" name="email" id="email"
        placeholder="u@dom.com" value="ifNonValid" class="form-control">
    */
    $fldAttribs = $origfldAttr;
    if((!isset($fldAttribs['name'])) && (isset($fldAttribs['type']))) {
      $fldAttribs['name'] = $fldAttribs['type'];
    }
    $field = $fldAttribs['name'];  // form field 'name' = db model field (default)
    $values = $model->getCols();

    if (isset($values[$field]) && (!empty($values[$field]))) {
        $fldAttribs['value'] = $values[$field];
    }
    return $this->retInpTypeDiv($field, $fldAttribs);
  }
}
