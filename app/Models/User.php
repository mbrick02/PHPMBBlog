<?php

namespace app\Models;

class User extends DB {
  static protected $table = "users";

  static protected $columns = [
    'id' => "",
    'privilege_id' => "",
    'username' => "",
    'email'=> "",
    'fname'=> "",
    'lname'=> "",
    'password_required' => true,  // default require password
    'password' => "",
    'confirm_password' => "",
    'hashed_password' => "",
    'created_at'=> "",
    'updated_at'=> "",
  ];

  static protected $uniqueFlds = array("username", "email");

  static protected $notInDBCols =
    array("password", "confirm_password", "password_required", "created_at", "updated_at");
// ?? Do we need to check form $columns->$keys == $args->$keys ???
  protected static function initializeModel($args) {
    $formAry = rtrim(static::$table, "s"); // "user"; // ?always table name minus ending 's'
    foreach (static::$columns as $key => &$value) {
      if($key == 'id') { continue; } // form should not have id
      if($key == 'privilege_id') {
        static::$columns[$key] = 2;  // user (2) privs -- other privs set elsewhere
        continue;
      }
      if (isset($args[$formAry][$key])){
        $value = $args[$formAry][$key]; // ***10/28 $args[$argsNameAry][$key]
      } // DEBUG**: else { echo $key . " field not on form."; die(); }
    }
    if (!empty(static::$columns['password'])){
      // $hashed_password = password_hash($password, PASSWORD_DEFAULT);
      // retrieve: if(password_verify($password, $hashed_password)) {
      static::$columns['hashed_password'] = password_hash(static::$columns['password'], PASSWORD_DEFAULT, ['cost' => 12]);
    }
    parent::initializeModel($args);
  }

/* should NOT need
  public static function getInstance($args = [], $table = "", $db = null) {
    static::initializeModel($args);
    parent::getInstance();
  }   *********************     */

  public function fullname() {
    return static::$columns['fname'] . " " . static::$columns['lname'];
  }

  private function testUnique() {

  }

  public function validate() {
    $this->errors = [];

    // Note: "$ary[] =" means push onto $ary NOT reassign
    if(is_blank(static::$columns['fname'])) {
      $this->errors[] = "First name cannot be blank.";
    } elseif (!has_length(static::$columns['fname'], array('min' => 2, 'max' => 255))) {
      $this->errors[] = "First name must be between 2 and 255 characters.";
    }

    if(is_blank(static::$columns['lname'])) {
      $this->errors[] = "Last name cannot be blank.";
    } elseif (!has_length(static::$columns['lname'], array('min' => 2, 'max' => 255))) {
      $this->errors[] = "Last name must be between 2 and 255 characters.";
    }

    if(is_blank(static::$columns['email'])) {
      $this->errors[] = "Email cannot be blank.";
    } elseif (!has_length(static::$columns['email'], array('max' => 255))) {
      $this->errors[] = "Last name must be less than 255 characters.";
    } elseif (!has_valid_email_format(static::$columns['email'])) {
      $this->errors[] = "Email must be a valid format.";
    }

    if(is_blank(static::$columns['username'])) {
      $this->errors[] = "Username cannot be blank.";
    } elseif (!has_length(static::$columns['username'], array('min' => 3, 'max' => 255))) {
      $this->errors[] = "Username must be between 8 and 255 characters.";
    }

    if(static::$columns['password_required']) {
      if(is_blank(static::$columns['password'])) {
        $this->errors[] = "Password cannot be blank.";
      } elseif (!has_length(static::$columns['password'], array('min' => 8))) {
        $this->errors[] = "Password must contain 8 or more characters";
      } elseif (!preg_match('/[A-Z]/', static::$columns['password'])) {
        $this->errors[] = "Password must contain at least 1 uppercase letter";
      } elseif (!preg_match('/[a-z]/', static::$columns['password'])) {
        $this->errors[] = "Password must contain at least 1 lowercase letter";
      } elseif (!preg_match('/[0-9]/', static::$columns['password'])) {
        $this->errors[] = "Password must contain at least 1 number";
      } elseif (!preg_match('/[^A-Za-z0-9\s]/', static::$columns['password'])) {
        $this->errors[] = "Password must contain at least 1 symbol";
      }

      if(is_blank(static::$columns['confirm_password'])) {
        $this->errors[] = "Confirm password cannot be blank.";
      } elseif (static::$columns['password'] !== static::$columns['confirm_password']) {
        $this->errors[] = "Password and confirm password must match.";
      }
    }

    parent::validate(); // call checkUnique and other default functions

    return $this; // Skoglund returned: $this->errors;
  }

// id, username, email, fname, lname, password,
//    remember_token, created_at, updated_at

/*
remember_token
No. It's not supposed to be used to authenticate.
It's used by the framework to help against Remember Me cookie hijacking.
The value is refreshed upon login and logout.
If a cookie is hijacked by a malicious person,
logging out makes the hijacked cookie useless since it doesn't match anymore.
*/

}
