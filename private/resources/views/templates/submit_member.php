<?php
require_once('del_spcodecrsmdl_task.class.php');

$validation_helper = new Validation_helper;
$mdl_members = new Mdl_members;

// get the posted form variables
$data = $mdl_members->get_data_from_post();
extract($data); // $data['first_name'] now is $first_name etc.

// ?? probably don't need: ??$submit = $_POST['submit'];

$validation_helper->check_required('first_name', 'first name');
$validation_helper->check_required('last_name', 'last name');
$validation_helper->check_required('username', 'username');
$validation_helper->check_required('email', 'email address');
$validation_helper->check_valid_email('email', 'email address');
$validation_helper->check_required('country_id', 'country');
$validation_helper->check_numeric('country_id', 'country');

// respond to validation result
$got_errors = $validation_helper->got_errors();

if ($got_errors) {
  require_once 'create_member.php'; // require_once TEMPLATE_PATH . DS . 'create_member.php';
} else {
  echo 'well done!'; // create a new record  See submitTask.php
  // exmp creat:   $mysql_query = "INSERT INTO  `members`(`title`, `description`, `completed`)
    // VALUES ('$task_title', '$descripton', $finished)";
  //  $flash_msg = 'The record was successfully created.';
  // examp if update: $mysql_query = "UPDATE `tasks` SET `title` = '$task_title', `description`= '$descripton', `completed` = $finished WHERE `id`= $update_id";
  //  if create:
}
