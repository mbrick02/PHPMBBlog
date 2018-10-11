<?php
use app\Models\User as User;
// get all products
$app->get('/user/create', function(){
  $user = User::getInstance();

  if(!$user->count()) {
irst()->username;
  }

  // DEBUG: echo json_encode($products->results()) . '<br />';

})->setName('user.create');
