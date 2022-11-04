<?php
session_start();
include_once '../connections/db-connect.php';

if (isset($_POST["unit"])) {
    $sql = "
    SELECT
    inventory_tbl.item, 
    inventory_tbl.item_description,
    end_user_tbl.serial_number,
    end_user_tbl.end_user,
    end_user_tbl.date_received,
    end_user_tbl.designation,
    inventory_tbl.unit_cost
    
    
    FROM inventory_tbl
    INNER JOIN end_user_tbl ON inventory_tbl.id=end_user_tbl.id 
    

    WHERE end_user_tbl.unit='".$_POST["unit"]."' ORDER BY end_user_tbl.designation DESC, end_user_tbl.end_user
    ";

    $result = mysqli_query($conn, $sql);

    $resultCheck = mysqli_num_rows($result);
    $row = array();
    while($row[] = mysqli_fetch_array($result)){

    }
    echo json_encode($row);
}

?>
