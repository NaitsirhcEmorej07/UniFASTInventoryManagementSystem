<?php
session_start();
include_once '../connections/db-connect.php';

if (isset($_POST["sntobtn"])) {
    $sql = "SELECT * FROM item_logs_tbl WHERE serial_number='".$_POST["sntobtn"]."' ORDER BY date_received DESC";
    $result = mysqli_query($conn, $sql);

    $resultCheck = mysqli_num_rows($result);
    $row = array();
    while($row[] = mysqli_fetch_array($result)){

    }
    echo json_encode($row);
}

?>
