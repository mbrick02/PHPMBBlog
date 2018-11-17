<?php

class Session {
  private $user_id;
  public $username;
  private $last_login;
  // public const MAX_LOGIN_AGE = 60*60*24; // v7.1 NOT 7.0 1 day
  const MAX_LOGIN_AGE = 60*60*24; // 1 day
  // define('MAX_LOGIN_AGE', 60*60*24);
  public function __construct() {
    session_start();
    $this->check_stored_login();
  }

  // Codecourse PHP OOP Login CSRF (p12/23)  session/token ***
  public static function exists($name) {
    return (isset($_SESSION[$name]) ? true : false);
  }

  public static function put($name, $value){
    return $_SESSION[$name] = $value;
  }

  public static function get($name) {
  return $_SESSION[$name];
  }

  public static function delete($name) {
    if(self::exists($name)) {
    unset($_SESSION[$name]);
    }
  }

// end Codecourse PHP OOP Login CSRF (p12/23)  session/token ***

  public function login($user) {
    if($user) {
      // prevent session fixation attacks
      session_regenerate_id();
      $this->user_id = $_SESSION['user_id'] = $user->id;
      $this->username = $_SESSION['username'] = $user->username;
      // $this->username = $_SESSION['fullname'] = $user->fullname();
      $this->last_login = $_SESSION['last_login'] = time();
    }
    return true;
  }

  public function is_logged_in() {
    // return isset($this->user_id);
    return isset($this->user_id) && $this->last_login_is_recent();
  }

  public function logout() {
    unset($_SESSION['user_id']);
    unset($_SESSION['username']);
    // unset($_SESSION['fullname']);
    unset($_SESSION['last_login']);
    unset($this->user_id);
    unset($this->username);
    unset($this->last_login);
    return true;
  }

  private function check_stored_login() {
    if(isset($_SESSION['user_id'])) {
      $this->user_id = $_SESSION['user_id'];
      $this->username = $_SESSION['username'];
      $this->last_login = $_SESSION['last_login'];
    }
  }

  private function last_login_is_recent() {
    if(!isset($this->last_login)) {
      return false;
    } elseif(($this->last_login + self::MAX_LOGIN_AGE) < time()) {
      return false;
    } else {
      return true;
    }
  }

  public static function message($msg="") {
    // SECURITY NOTE: can NOT have user content in message -- h($msg) for any user content
    if(!empty($msg)) {
      // Then this is a "set" message
      $_SESSION['message'] = $msg;
      return true;
    } else {
      // Then this is a "get" message
      $sessMsg = isset($_SESSION['message']) ? $_SESSION['message'] : '';
      unset($_SESSION['message']);
      return $sessMsg;
    }
  }

  public function getMsg($msg="") { // instance get message
    return self::message($msg);
  }

  public static function errMsg($errmsg=[]) {
    /*  Get/Set $_SESSION['errors']
    input: array of errorm messages OR
      output: array of error messages */
    // SECURITY NOTE: can NOT have user content in message -- h($msg) for any user content
    if(!empty($errmsg)) {
      // Then this is a "set" message
      $_SESSION['errors'] = $errmsg;
      return true;
    } else {
      // Then this is a "get" message
      return $_SESSION['errors'] ?? '';
    }
  }

  public static function clear_message() {
    unset($_SESSION['message']);
  }

  public static function clear_errors() {
    unset($_SESSION['errors']);
  }

  public function display_errors($errors=array()) {
    $output = '';
    if(!empty($errors)) {
      $output .= "<div class=\"errors\">";
      $output .= "Please fix the following errors:";
      $output .= "<ul>";
      foreach($errors as $error) {
        $output .= "<li>" . h($error) . "</li>";
      }
      $output .= "</ul>";
      $output .= "</div>";
    }
    static::clear_errors();
    return $output;
  }

  public function display_session_message() {
    // SECURITY NOTE: can NOT have user content in message -- h($msg) for any user content
    $msg = static::message();
    $output = "";

    if(isset($msg) && ($msg != '')) {
      if (is_array($msg)){
        $output .= "Concerns:";
        $output .= "<ul>";
        foreach($msg as $item) {
          $output .= "<li>" . h($error) . "</li>";
        }
        $output .= "</ul>";
      } else {
        $output .= $msg;
      }

      static::clear_message();
      return '<div id="message">' . $output . '</div>';
    } // else return nothing so that
  }
}
?>
