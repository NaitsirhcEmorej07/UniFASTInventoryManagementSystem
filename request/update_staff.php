<?php
session_start();
include_once '../connections/db-connect.php';



    $enduser_id = $_POST['enduser_id'];
    $end_user = $_POST['end_user'];
    $date_received = $_POST['date_received'];
    $serial_number = $_POST['serial_number'];
    $inventory_item_number = $_POST['inventory_item_number'];
    $ics_number = $_POST['ics_number'];


    $sql = "update " . $TBL_END_USER  . " 
    set 
    end_user =UPPER('$end_user'), 
    date_received =UPPER('$date_received'), 
    serial_number =UPPER('$serial_number'),  
    inventory_item_number =UPPER('$inventory_item_number'), 
    ics_number =UPPER('$ics_number')
    where enduser_id='$enduser_id' ";

    $conn->query($sql) or die ($conn->error);        
