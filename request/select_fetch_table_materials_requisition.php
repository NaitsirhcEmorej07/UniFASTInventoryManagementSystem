<?php
session_start();
include_once '../connections/db-connect.php';

if (isset($_GET["plantilla"])) {

    $sql1 = " 
    SELECT * FROM " . $TBL_UNIFAST_STAFF  . " WHERE full_name='".$_GET["plantilla"]."' ";
    $result = mysqli_query($conn, $sql1);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    $sql = "
    SELECT item, 
    item_description, 
    quantity, 
    assigned, 
    unit_cost, 
    total_cost, 
    date_acquired, 
    supplier_warranty 

    FROM " . $TBL_INVENTORY . " 
    WHERE received_by ='".$_GET["plantilla"]."' ";
    $result = mysqli_query($conn, $sql);
    $row['plantillaitem'] = mysqli_fetch_all($result, MYSQLI_ASSOC);
  

    echo json_encode($row);
}

?>
