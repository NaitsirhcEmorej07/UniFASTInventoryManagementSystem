<?php
session_start();
include_once '../connections/db-connect.php';

if (isset($_POST["viewupdatebtnx"])) {

    $sql = "SELECT * FROM " . $TBL_END_USER  . " 
    LEFT JOIN " . $TBL_UNIFAST_STAFF . " ON " . $TBL_END_USER . ".enduser_list_id = " . $TBL_UNIFAST_STAFF . ".enduser_list_id 
    
    WHERE enduser_id='".$_POST["viewupdatebtnx"]."' ";
    $result = mysqli_query($conn, $sql);

    $resultCheck = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);
    echo json_encode($row);
}