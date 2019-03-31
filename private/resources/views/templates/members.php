<?php
if(!isset($_SESSION)) {
    session_start();
}
/* MB mbblog ver uses del_spcode... below:
require_once 'class/Flashdata_helper.php';
require_once 'class/Mdl_members.php'; */
require_once('del_spcodecrsmdl_task.class.php');

$flashdata_helper = new Flashdata_helper;
$mdl_members = new Mdl_members;
$result = $mdl_members->fetch_all();
// orig non-Slim speed code ver: require_once 'views/members/manage.php';
require_once TEMPLATE_PATH . DS . 'members' . DS . 'manage.php';
?>
