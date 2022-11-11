<?php
session_start();
include_once '../connections/db-connect.php';


    $sql = "
    SELECT enduser_id FROM $TBL_END_USER WHERE enduser_id = '".$_POST["end_user_id"]."'
    ";
    $result = mysqli_query($conn, $sql);

    $resultCheck = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);
    echo json_encode($row);


