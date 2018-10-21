<?php

namespace app\Models;

class User extends DB {
  static protected $table = "users";
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
	protected function __construct($args=[]) {
    foreach (static::$columns as $key => $value) {
      if($key == 'id') { continue; } // form should not have id
      if($key == 'privilege_id') {
        static::$columns[$key] = 2;  // user (2) privs -- other privs set elsewhere
        continue;
      }
      if (isset($args[$key])){
        static::$columns[$key] = $args[$key];
      } // DEBUG**: else { echo $key . " field not on form."; die(); }
    }

    parent::__construct(); // connect to db (w/users table)
  }

  protected function validate() {
    $this->errors = [];

    if(is_blank($this->fname)) {
      $this->errors[] = "First name cannot be blank.";
    } elseif (!has_length($this->fname, array('min' => 2, 'max' => 255))) {
      $this->errors[] = "First name must be between 2 and 255 characters.";
    }

    if(is_blank($this->lname)) {
      $this->errors[] = "Last name cannot be blank.";
    } elseif (!has_length($this->lname, array('min' => 2, 'max' => 255))) {
      $this->errors[] = "Last name must be between 2 and 255 characters.";
    }

    if(is_blank($this->email)) {
      $this->errors[] = "Email cannot be blank.";
    } elseif (!has_length($this->email, array('max' => 255))) {
      $this->errors[] = "Last name must be less than 255 characters.";
    } elseif (!has_valid_email_format($this->email)) {
      $this->errors[] = "Email must be a valid format.";
    }

    if(is_blank($this->username)) {
      $this->errors[] = "Username cannot be blank.";
    } elseif (!has_length($this->username, array('min' => 8, 'max' => 255))) {
      $this->errors[] = "Username must be between 8 and 255 characters.";
    }

    if($this->password_required) {
      if(is_blank($this->password)) {
        $this->errors[] = "Password cannot be blank.";
      } elseif (!has_length($this->password, array('min' => 12))) {
        $this->errors[] = "Password must contain 12 or more characters";
      } elseif (!preg_match('/[A-Z]/', $this->password)) {
        $this->errors[] = "Password must contain at least 1 uppercase letter";
      } elseif (!preg_match('/[a-z]/', $this->password)) {
        $this->errors[] = "Password must contain at least 1 lowercase letter";
      } elseif (!preg_match('/[0-9]/', $this->password)) {
        $this->errors[] = "Password must contain at least 1 number";
      } elseif (!preg_match('/[^A-Za-z0-9\s]/', $this->password)) {
        $this->errors[] = "Password must contain at least 1 symbol";
      }

      if(is_blank($this->confirm_password)) {
        $this->errors[] = "Confirm password cannot be blank.";
      } elseif ($this->password !== $this->confirm_password) {
        $this->errors[] = "Password and confirm password must match.";
      }
    }

    return $this->errors;
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
