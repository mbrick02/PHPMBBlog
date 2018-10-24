<?php
use app\Models\User as User;

$app->group('/user', function() use ($app){
  $app->get('/create', 'AuthController:getSignup')->setName('user.create');

  $app->post('/create', 'AuthController:postSignup');
});
