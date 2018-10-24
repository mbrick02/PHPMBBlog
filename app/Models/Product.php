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
    'title' => "",
    'description'=> "",
    'price'=> "",
    'created_at'=> "",
    'updated_at'=> "",
  ];

  protected static function initializeModel($args) {
    if (static::$table != "products") {
        static::$table = "products";
    }
    if (!isset(static::$columns['title'])) { // currently title is unique to products
      static::$columns = [
        'id' => "",
        'imagePath' => "",
        'title' => "",
        'description'=> "",
        'price'=> "",
        'created_at'=> "",
        'updated_at'=> "",
      ];
    }
  } // ** End initializeModel
}
