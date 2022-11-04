<?php
session_start();
include_once '../connections/db-connect.php';

if (isset($_POST["serialnumber"])) {
    $sql = "
    SELECT
    inventory_tbl.item, 
    inventory_tbl.item_description,
    inventory_tbl.supplier,
    inventory_tbl.unit_cost,
    inventory_tbl.received_by,
    inventory_tbl.supplier_warranty,
    end_user_tbl.end_user, 
    end_user_tbl.inventory_item_number, 
    end_user_tbl.date_received,
    end_user_tbl.serial_number,
    end_user_tbl.ics_number,
    end_user_tbl.inventory_item_number


    FROM inventory_tbl
    INNER JOIN end_user_tbl ON inventory_tbl.id=end_user_tbl.id 

    WHERE end_user_tbl.serial_number = '".$_POST["serialnumber"]."'
    ";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_row($result);


    $sql1 = "SELECT * FROM item_logs_tbl WHERE serial_number = '".$_POST["serialnumber"]."' ORDER BY date_received DESC ";
    $result = mysqli_query($conn, $sql1);
    $row['history'] = mysqli_fetch_all($result, MYSQLI_ASSOC);


    echo json_encode($row);





}

