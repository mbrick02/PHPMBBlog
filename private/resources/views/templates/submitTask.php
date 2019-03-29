<?php
if(!isset($_SESSION)) {
    session_start();
}
if (!isset($_POST)) {
    die('You should not be here.');
}

$submit = $_POST['submit'];
if ($submit == 'Submit') {
    // process the form
    $task_title = $_POST['title'];
    $descripton = $_POST['description'];

    if (!isset($_POST['finished'])) {
        $finished = 0;
    } else {
        $finished = 1;
    }

    // $date_created = time(); not used - auto created_at


    require_once 'del_spcodecrsmdl_task.class.php';
    $mdl_tasks = new Mdl_tasks;

    if (isset($_POST['update_id'])) {
        // update the record [note: he got code from phpMyAdmin - record ->[Edit]
        $update_id = $_POST['update_id'];
        $mysql_query = "UPDATE `tasks` SET `title` = '$task_title', `description`= '$descripton', `completed` = $finished WHERE `id`= $update_id";
        $flash_msg = 'The record was successfully updated.';
    } else {
        // insert a new record
      $mysql_query = "
      INSERT INTO  `tasks`
      (`title`, `description`, `completed`)
      VALUES
      ('$task_title', '$descripton', $finished)
      ";
      $flash_msg = 'The record was successfully created.';
    }

    if ($mdl_tasks->query($mysql_query)) { // do the query (insert or  update)
      // set the flashdata
      $_SESSION['flash_msg'] = $flash_msg;

      // redirect back to index.php
      header('location: /indexSCATask');
      die();
    } else {
      echo 'error in Task action please make corrections or contact admin';
      die();
    }
} elseif ($submit == 'Delete') {
  // delter the record
  $update_id = $_POST['update_id'];
  $mysql_query = 'delete from tasks where id='.$update_id;

  require_once 'del_spcodecrsmdl_task.class.php';
  $mdl_tasks = new Mdl_tasks;
  $mdl_tasks->query($mysql_query);
  $flash_msg = 'The record was successfully updated.';

  if ($mdl_tasks->query($mysql_query)) { // do the query (insert or  update)
    // set the flashdata
    $_SESSION['flash_msg'] = $flash_msg;

    // redirect back to index.php
    header('location: /indexSCATask');
    die();
  } else {
    echo 'error in Task action please make corrections or contact admin';
    die();
  }
}
