<?php
use app\Models\User as User;
// get all products
$app->get('/user/create', 'AuthController:create')->setName('user.create');
