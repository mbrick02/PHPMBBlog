<?php

class Mdl_tasks
{  // ***DELETE afte SpeedCoding course
    private $pdo;

    public function __construct()
    {
        // connect to the database
        $host = 'localhost';
        $user = 'michael';
        $password = 'Job4Fau';// for MAMP others empty '' by default
        $dbname = 'mbblog';

        // set DSN (data source name)
        $dsn = 'mysql:host='.$host.';dbname='.$dbname;
        // mysql:host=localhost;dbname=test

        //create a PDO instance
        $this->pdo = new PDO($dsn, $user, $password);
    }

    public function query($mysql_query)
    {
        $stmt = $this->pdo->query($mysql_query); // statement/result or false

        return $stmt;
    }
}

class Flashdata_helper {
  //  MB materializecss note s12=full width, m6 is half for med screens
  private $html_start = '<div class="row">
    <div class="col s12">
      <div class="card blue-grey darken-1">
        <div class="card-content white-text">
          <span class="card-title">Result Message:</span>
          <p>';

    private $html_end = '</p>
        </div>
        <!-- <div class="card-action">
          <a href="#">This is a link</a>
          <a href="#">This is a link</a>
        </div> -->
      </div>
    </div>
  </div>';

  function set_flashdata($msg, $theme) { // UNUSED possible expansion
    $_SESSION['flash_msg'] = $msg;
    $_SESSION['flash_theme'] =  $theme; // could be used to chng msg look
  }

  function flashdata() {
      // attempt to display flash_msg
      if (isset($_SESSION['flash_msg'])) {
        echo $this->html_start .$_SESSION['flash_msg'].$this->html_end;
        unset($_SESSION['flash_msg']);
      }
  }
}

class Mdl_members {

    private $pdo;

    function __construct() {
        //connect to the database
        $host = 'localhost';
        $user = 'michael';
        $password = 'Job4Fau';// for MAMP others empty '' by default
        $dbname = 'mbblog';

        //set the DSN
        $dsn = 'mysql:host='.$host.';dbname='.$dbname;

        //create a PDO instance
        $this->pdo = new PDO($dsn, $user, $password);
    }

    function query($mysql_query) {
        //executes a MySQL query and returns the result
        $result = $this->pdo->query($mysql_query);
        return $result;
    }

    function get_countries() {
        $countries = [];
        $mysql_query = 'select * from countries order by country';
        $result = $this->pdo->query($mysql_query);
        //loop through the results
        while ($row = $result->fetch(PDO::FETCH_OBJ)) {
            $countries[$row->id] = $row->country; //add to countries array
        }

        return $countries;
    }
  }
