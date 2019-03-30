<?php
if (isset($member_id) && (!$member_id == '')) {
    // MB Slim Note: $update_id set in createTask controller
    $update_id = $member_id;
    $headline = 'Update Member';
    /* from original NON-Slim speed code ver:
    if (isset($_GET['id'])) {
        $update_id = $_GET['id'];
        $headline = 'Update Member'; */

    //fetch the member title from the database
    // orig non-Slim Speed Code ver: require_once 'class/Mdl_members.php';
    require_once('del_spcodecrsmdl_task.class.php');

    $mdl_members = new Mdl_members;
    $mysql_query = 'select * from members where id = '.$update_id;
    $result = $mdl_members->query($mysql_query);
    while ($row = $result->fetch(PDO::FETCH_OBJ)) {
        $username = $row->username;
        $email = $row->email;
    }
} else {
    $headline = 'Create New Member';
    $username = '';
    $email = '';
}

// orig from sped code: require_once 'views/members/create.php';
require_once TEMPLATE_PATH . DS . 'members' . DS . 'create.php';
