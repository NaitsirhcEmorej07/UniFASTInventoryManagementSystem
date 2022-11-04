<?php
session_start();
include_once '../connections/db-connect.php';

if (isset($_POST["itm1"])) {
    $sql = "
    SELECT
    " . $TBL_INVENTORY . ".item, 
    " . $TBL_INVENTORY . ".item_description,
    " . $TBL_INVENTORY . ".received_by,
    " . $TBL_INVENTORY . ".supplier_warranty,
    " . $TBL_END_USER  . ".date_received,
    " . $TBL_END_USER  . ".serial_number,
    " . $TBL_INVENTORY . ".unit_cost
    
    
    FROM " . $TBL_INVENTORY . "
    INNER JOIN " . $TBL_END_USER  . " ON " . $TBL_INVENTORY . ".id=" . $TBL_END_USER  . ".id 
    

    WHERE " . $TBL_END_USER  . ".end_user ='".$_POST["itm1"]."' ";
    


    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    $row = array();
    while($row[] = mysqli_fetch_array($result)){

    }
    echo json_encode($row);
}

?>
