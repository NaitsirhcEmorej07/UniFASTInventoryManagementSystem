<?php
session_start();
include_once '../connections/db-connect.php';

if (isset($_POST["unit"])) {
    $sql = "
    SELECT
    " . $TBL_INVENTORY . ".item, 
    " . $TBL_INVENTORY . ".item_description,
    " . $TBL_END_USER  . ".serial_number,
    " . $TBL_END_USER  . ".end_user,
    " . $TBL_END_USER  . ".date_received,
    " . $TBL_END_USER  . ".designation,
    " . $TBL_INVENTORY . ".unit_cost,
    " . $TBL_UNIFAST_STAFF  . ".*
    
    
    FROM " . $TBL_INVENTORY . "
    INNER JOIN " . $TBL_END_USER  . " ON " . $TBL_INVENTORY . ".id=" . $TBL_END_USER  . ".id 
    LEFT JOIN " . $TBL_UNIFAST_STAFF . " ON " . $TBL_END_USER . ".enduser_list_id = " . $TBL_UNIFAST_STAFF . ".enduser_list_id 

    WHERE " . $TBL_END_USER  . ".unit='".$_POST["unit"]."' ORDER BY " . $TBL_END_USER  . ".designation DESC, " . $TBL_END_USER  . ".end_user
    ";

    $result = mysqli_query($conn, $sql);

    $resultCheck = mysqli_num_rows($result);
    $row = array();
    while($row[] = mysqli_fetch_array($result)){

    }
    echo json_encode($row);
}

?>
