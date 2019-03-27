<?php

namespace app\Models;
// use private\classes\db.class.php;
// PRIVATE_PATH . DS . 'classes' . DS . 'db.class.php';

class Task extends DB {
  static protected $table = "tasks";
  // Note: password is hashed
  static protected $columns = [
    'id' => "",
    'title' => "",
    'description'=> "",
    'created_at'=> "",
    'updated_at'=> "",
  ];
}
