<?php
session_start();
include_once '../connections/db-connect.php';

if (isset($_POST["staffupdatebtn"])) {

    $sql = "SELECT * FROM " . $TBL_UNIFAST_STAFF  . " WHERE enduser_list_id='".$_POST["staffupdatebtn"]."' ";
    $result = mysqli_query($conn, $sql);

    $resultCheck = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);
    echo json_encode($row);
}

