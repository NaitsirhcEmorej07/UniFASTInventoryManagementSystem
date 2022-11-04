<?php
session_start();
include_once '../connections/db-connect.php';

if (isset($_POST["viewupdatebtnx"])) {

    $sql = "SELECT * FROM end_user_tbl WHERE enduser_id='".$_POST["viewupdatebtnx"]."' ";
    $result = mysqli_query($conn, $sql);

    $resultCheck = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);
    echo json_encode($row);
}