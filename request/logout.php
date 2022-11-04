<?php
include_once '../connections/db-connect.php';

if(!isset($_SESSION))
{
    session_start();
}

$username = $_SESSION['user_login'];
$sql1 = "update user_tbl set status='0' where username = '$username' ";
$conn->query($sql1) or die ($conn->error); 


unset($_SESSION['user_login']);
echo header("Location: ../index.php");
?>
