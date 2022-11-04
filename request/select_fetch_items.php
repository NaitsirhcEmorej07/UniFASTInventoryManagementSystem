<?php
session_start();
include_once '../connections/db-connect.php';

if (isset($_POST["viewbtnvalx"])) {
    $sql = "SELECT * FROM inventory_tbl WHERE id='".$_POST["viewbtnvalx"]."' ";
    $result = mysqli_query($conn, $sql);

    $resultCheck = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);
    echo json_encode($row);
}

