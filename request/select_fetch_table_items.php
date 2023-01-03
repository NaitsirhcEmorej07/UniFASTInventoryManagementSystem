<?php
session_start();
include_once '../connections/db-connect.php';

if (isset($_POST["f1x"])) {
    $sql1 = "SELECT * FROM " . $TBL_INVENTORY . " WHERE id='" . $_POST["f1x"] . "' ";
    $result = mysqli_query($conn, $sql1);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);


    $sql =
    
    "SELECT *, tbl_ims_end_user.status FROM tbl_ims_end_user
    left JOIN tbl_unifast_staff ON tbl_unifast_staff.enduser_list_id = tbl_ims_end_user.enduser_list_id
    WHERE
    tbl_ims_end_user.id = " . $_POST["f1x"];

    $result = mysqli_query($conn, $sql);
    $row['end_users'] = mysqli_fetch_all($result, MYSQLI_ASSOC);

    echo json_encode($row);
}
