<?php
require_once('del_spcodecrsmdl_task.class.php');

$mdl_members = new Mdl_members;

if (isset($member_id) && (!$member_id == '')) {
    // MB Slim Note: $update_id set in createTask controller
    $update_id = (int)$member_id;
    $headline = 'Update Member';
    /* from original NON-Slim speed code ver:
    if (isset($_GET['id'])) {
        $update_id = $_GET['id'];
        $headline = 'Update Member'; */

    //fetch the member details from the database
    // orig non-Slim Speed Code ver: require_once 'class/Mdl_members.php';
    require_once('del_spcodecrsmdl_task.class.php');

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
// DEBUG: echo $headline;
// DEBUG: die();

extract($data);

// orig from sped code: require_once 'views/members/create.php';
require_once TEMPLATE_PATH . DS . 'members' . DS . 'create.php';
