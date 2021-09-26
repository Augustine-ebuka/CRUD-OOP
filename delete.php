<?php
session_start();
require_once('./include/connect_db.php');
$db = new users_operation();
$id = $_GET['u_id'];
$result = $db->edit_user($id);

if ($db->delete($id))
global $db;
{
    if ($db->delete($id)) {
        $db->create_session('<div class="alert alert-danger"> 1 record deleted</div>');
        header("location:view.php");
    } else {
        $db->create_session('<div class="alert alert-danger"> unable to delete </div>');
    }


} 


?>
