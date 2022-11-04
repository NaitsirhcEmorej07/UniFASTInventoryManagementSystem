<?php
session_start();
include_once '../connections/db-connect.php';

if (isset($_POST["f1x"])) {
    $sql1 = "SELECT * FROM inventory_tbl WHERE id='" . $_POST["f1x"] . "' ";
    $result = mysqli_query($conn, $sql1);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    
    $sql = "SELECT * FROM end_user_tbl WHERE id=" . $_POST["f1x"];
    $result = mysqli_query($conn, $sql);
    $row['end_users'] = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    echo json_encode($row);




    // $from_date = "2022-11-04";
    // $new_date = date('Y-m-d', strtotime('+2 years', strtotime($from_date)));
}
