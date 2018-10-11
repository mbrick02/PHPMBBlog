<?php

namespace app\specialClasses;

class FormBuild {
  // protected $protectedVar;
/*
<!-- form fields ***** -->
<div class="form-group">
  <label for="email">Email</label>
  <input type="email" name="email" id="email" placeholder="u@dom.com" class="form-control">
</div>
<div class="form-group">
  <label for="name">Name</label>
  <input type="text" name="name" id="name" class="form-control">
</div>
<div class="form-group">
  <label for="password">Password</label>
  <input type="password" name="password" id="password" class="form-control">
</div>
"\n" for newline (Linux & Mac -- Win takes it okay)
*/
  function returnTxtField($assiVars = []) {
      // returnTxtField $assiVars needs empty string or val for lblFor, lbl, type, name, id, and class
      $placehold = empty($assiVars['placeholder']) ? "": "placeholder=\"{$assiVars['placeholder']}\"";

      $output = "<div class=\"form-group\"> \n";
      $output .= "<label for=\"{$assiVars['lblFor']}\">{$assiVars['lbl']}</label>\n";
      $output .= "<input type=\"{$assiVars['type']}\" name=\"{$assiVars['name']}\" id=\"{$assiVars['id']}\" ">";
      $output .= "{$placehold}class=\"{$assiVars['class']}\">";
      $output .= "</div>";

      return $output;

    } // DEBUG**: else { "returnTxtField with now assignedVars"}
  }

  function returnTxtArea($assiVars = []) {
// <textarea maxlength="200" rows="4" cols="50" id="id" name="name"
// placeholder="placeholdertext text text" wrap="hard"></textarea>
    // returnTxtField $assiVars needs empty string or val for lblFor, lbl, type, name, id, and class
    $placehold = empty($assiVars['placeholder']) ? "": "placeholder=\"{$assiVars['placeholder']}\"";
    $rows = empty($assiVars['rows']) ? "rows=\"4\" " : $assiVars['rows'];
    $cols = empty($assiVars['cols']) ? "cols=\"50\" " : $assiVars['cols'];
    // for maxlength and minlength I might want to go with isset() ?? or array_key_exists or empty??
    $maxLngth = isset($assiVars['maxlength']) ? "" : ? "": "maxlength=\"{$assiVars['maxlength']}\"";
    $minLngth = isset($assiVars['minlength']) ? "" : ? "": "minlength=\"{$assiVars['minlength']}\"";

    $output = "<textarea maxlength="200" rows="4" cols="50" id="id" name="name" ";
    $output .= "placeholder="placeholdertext text text" wrap="hard"></textarea>";
    $output .= "";
  }
}
