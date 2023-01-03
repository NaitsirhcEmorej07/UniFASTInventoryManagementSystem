<?php
session_start();
include_once '../connections/db-connect.php';

if (isset($_POST["sntobtn"])) {
    // $sql = "SELECT * FROM " . $TBL_LOGS  . " WHERE serial_number='".$_POST["sntobtn"]."' ORDER BY date_received DESC";
    
    
    $sql = "
    SELECT *, tbl_ims_logs.status FROM tbl_ims_logs   
    LEFT JOIN tbl_unifast_staff ON tbl_unifast_staff.enduser_list_id = tbl_ims_logs.end_user
    WHERE serial_number = '".$_POST["sntobtn"]."' ORDER BY date_received DESC
    ";
    $result = mysqli_query($conn, $sql);

    
    $resultCheck = mysqli_num_rows($result);
    $row = array();
    while($row[] = mysqli_fetch_array($result)){

    }
    echo json_encode($row);
}

?>
