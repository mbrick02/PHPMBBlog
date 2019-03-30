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

$mysql_query = 'SELECT countries.country,
                    members.*
                FROM members INNER JOIN countries ON members.country_id = countries.id
                order by members.username';

$result = $mdl_members->query($mysql_query);
// orig non-Slim speed code ver: require_once 'views/members/manage.php';
require_once TEMPLATE_PATH . DS . 'members' . DS . 'manage.php';
?>
