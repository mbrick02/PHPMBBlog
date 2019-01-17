<?php
  use app\specialClasses\FormBuild as FormBuild;
  /*
    <div class=""><div class="panel-heading">Sign up</div>
    <div class="panel-body">
  */
  /*
    (left) colmdoffset encloses: panel-heading + panel-body
  */
  /*  *** ?? 1/16/19  I think commented out below was the original page design???:
  retClosedTag($tagType, $assiVars = [], $tagContent="")
  <div class ="col-md-6 col-md-offset-1 float-left">
  <div class ="panel-heading">
  <h2>Sign up</h2></div>
  <div class ="panel-body">

  FormBuild::retClosedTag
  *** */

  $formContent = FormBuild::retClosedTag("div", ['class' => 'panel-heading'], "<h2>MB Blog</h2>");
  $formContent = $formContent . FormBuild::retClosedTag("div", ['class' => 'panel-body'], "Welcome to MB Blog");

  // enclose above in Bootstrap grid left col div
  $formContent = FormBuild::retClosedTag("div", ['class' => 'col-md-6 col-md-offset-1 float-left'], $formContent);

  echo $formContent;
