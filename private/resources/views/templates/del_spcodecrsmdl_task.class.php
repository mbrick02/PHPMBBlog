<?php

class Mdl_tasks  // *** use for lesson 17 and BEFORE ONLY -> use Mdl_members ****
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

class Flashdata_helper
{
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

    public function set_flashdata($msg, $theme)
    { // UNUSED possible expansion
        $_SESSION['flash_msg'] = $msg;
        $_SESSION['flash_theme'] =  $theme; // could be used to chng msg look
    }

    public function flashdata()
    {
        // attempt to display flash_msg
        if (isset($_SESSION['flash_msg'])) {
            echo $this->html_start .$_SESSION['flash_msg'].$this->html_end;
            unset($_SESSION['flash_msg']);
        }
    }
}

class Mdl_members
{
    private $pdo;
    private $form_fields = ['first_name', 'last_name', 'username', 'email', 'introduction', 'picture', 'country_id' ];

    public function __construct()
    {
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

    public function get_data_from_post()
    {
        // fetch all form fields that have been posted for one record
        $data = [];

        //get an array of all of the form fields
        $form_fields = $this->form_fields;
        foreach ($form_fields as $form_field) {
            if (!isset($_POST[$form_field])) {
                $data[$form_field] = '';
            } else {
                $data[$form_field] = $_POST[$form_field];
            }
        }

        return $data;
    }

    public function get_data_from_db($update_id)
    {
        // fetch all fields from db for one record
        $data = [];
        $mysql_query = 'select * from members where id = ' . $update_id;
        $result = $this->pdo->query($mysql_query);
        //loop through the results -- there should only be one
        while ($row = $result->fetch(PDO::FETCH_OBJ)) { // ??take out while - just $row =...?????
            $data['first_name'] = $row->first_name;
            $data['last_name'] = $row->last_name;
            $data['username'] = $row->username;
            $data['email'] = $row->email;
            $data['introduction'] = $row->introduction;
            $data['picture'] = $row->picture;
            $data['country_id'] = $row->country_id;
        }

        return $data;
    }

    public function fetch_all()
    {
        // fetch all records from members, including country data
        $mysql_query = 'SELECT countries.country,
                    members.*
                FROM members INNER JOIN countries ON members.country_id = countries.id
                order by members.username';

        $result = $this->query($mysql_query);
        return $result;
    }



    public function query($mysql_query)
    {
        //executes a MySQL query and returns the result
        $result = $this->pdo->query($mysql_query);
        return $result;
    }

    public function get_countries()
    {
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
