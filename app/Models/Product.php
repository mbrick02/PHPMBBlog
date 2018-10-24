<?php

namespace app\Models;
// use private\classes\db.class.php;
// PRIVATE_PATH . DS . 'classes' . DS . 'db.class.php';

class Product extends DB {
  static protected $table = "products";
  // Note: password is hashed
  static protected $columns = [
    'id' => "",
    'imagePath' => "",
    'product' => "",
    'description'=> "",
    'price'=> "",
    'created_at'=> "",
    'updated_at'=> "",
  ];
}
