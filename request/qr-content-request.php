<?php
session_start();
include_once '../connections/db-connect.php';

if (isset($_POST["serialnumber"])) {
    $sql = "
    SELECT
    " . $TBL_INVENTORY . ".item, 
    " . $TBL_INVENTORY . ".item_description,
    " . $TBL_INVENTORY . ".supplier,
    " . $TBL_INVENTORY . ".unit_cost,
    " . $TBL_INVENTORY . ".received_by,
    " . $TBL_INVENTORY . ".supplier_warranty,
    " . $TBL_END_USER  . ".end_user, 
    " . $TBL_END_USER  . ".inventory_item_number, 
    " . $TBL_END_USER  . ".date_received,
    " . $TBL_END_USER  . ".serial_number,
    " . $TBL_END_USER  . ".ics_number,
    " . $TBL_END_USER  . ".inventory_item_number


    FROM " . $TBL_INVENTORY . "
    INNER JOIN " . $TBL_END_USER  . " ON " . $TBL_INVENTORY . ".id=" . $TBL_END_USER  . ".id 

    WHERE " . $TBL_END_USER  . ".serial_number = '".$_POST["serialnumber"]."'
    ";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_row($result);


    $sql1 = "SELECT * FROM " . $TBL_LOGS  . " WHERE serial_number = '".$_POST["serialnumber"]."' ORDER BY date_received DESC ";
    $result = mysqli_query($conn, $sql1);
    $row['history'] = mysqli_fetch_all($result, MYSQLI_ASSOC);


    echo json_encode($row);





}

