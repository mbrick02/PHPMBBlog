<?php
use app\Models\User as User;
// get all products
$app->get('/user/create', 'AuthController:getSignup')->setName('user.create');

$app->post('/user/create', 'AuthController:postSignup');
