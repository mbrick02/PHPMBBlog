<?php

namespace app\Models;

class User extends DB {
  static protected $table_name = "users";
  // Note: password is hashed
  static protected $columns = [
    'id' => "",
    'privilege_id' => "",
    'username' => "",
    'email'=> "",
    'fname'=> "",
    'lname'=> "",
    'password'=> "",
    'confirm_password'=> "",
  ];

// ?? Do we need to check form $columns->$keys == $args->$keys ???
	private function __construct($args=[]) {
    foreach ($columns as $key => $value) {
      if($key == 'id') { continue; } // form should not have id
      if($key == 'privilege_id') {
        $columns[$key] = 2;  // user (2) privs -- other privs set elsewhere
        continue;
      }
      if (isset($args[$key])){
        $columns[$key] = $args[$key];
      } // DEBUG**: else { echo $key . " field not on form."; die(); }
    }

    parent::__construct(); // connect to db (w/users table)
  }

// id, username, email, fname, lname, password,
//    remember_token, created_at, updated_at
// similar to databaseobject of PHP OOP with DB:
//    	$aryFlds = array('username', 'password', 'first_name', 'last_name');
/*
remember_token
No. It's not supposed to be used to authenticate.
It's used by the framework to help against Remember Me cookie hijacking.
The value is refreshed upon login and logout.
If a cookie is hijacked by a malicious person,
logging out makes the hijacked cookie useless since it doesn't match anymore.
*/

}
