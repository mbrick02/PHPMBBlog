<?php
// require_one(init.php); - Speed Code version - in initialize for spl_autoload_register()
require_once('del_spcodecrsmdl_task.class.php');

$mdl_members = new Mdl_members;

if (!isset($member_id)) {
  $validation_helper = new Validation_helper;  // stop $validation_helper loading 2nd create.php
}

if (isset($member_id) && (!$member_id == '')) { // $member_id set in controller
    // MB Slim Note: $update_id set in createTask controller
    $update_id = (int)$member_id;
    $headline = 'Update Member';
    /* from original NON-Slim speed code ver:
    if (isset($_GET['id'])) {
        $update_id = $_GET['id'];
        $headline = 'Update Member'; */

    $data = $mdl_members->get_data_from_db($update_id);
} else {
    $headline = 'Create New Member';

    // attempt to fetch the member details from posted form form_fields
    $data = $mdl_members->get_data_from_post();
}

if (!isset($data['first_name'])) {
  $data= [];
  $data['first_name'] = '';
}

$countries = $mdl_members->get_countries();
if (is_numeric($data['country_id'])) {
  $selected_country_description = $countries[$data['country_id']];
} else {
  $selected_country_description = 'Choose country...';
}
extract($data);

// orig from sped code: require_once 'views/members/create.php';
require_once TEMPLATE_PATH . DS . 'members' . DS . 'create.php';
