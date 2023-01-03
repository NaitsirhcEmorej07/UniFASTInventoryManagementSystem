<?php
session_start();
include_once '../connections/db-connect.php';

$enduser_id = strtoupper($_POST['enduser_id']);
$end_user = $_POST['end_user'];
$date_received = $_POST['date_received'];
$serial_number = $_POST['serial_number'];
$inventory_item_number = $_POST['inventory_item_number'];
$ics_number = $_POST['ics_number'];
$status = $_POST['status'];


$sql1 = "select unit, enduser_list_id, designation, abbreviation,  employment_type from " . $TBL_UNIFAST_STAFF  . " where enduser_list_id  = '" . $_POST["end_user"] . "' ";
$result = mysqli_query($conn, $sql1);
while ($row = mysqli_fetch_array($result)) {

    $unit =  $row["unit"];
    $designation =  $row["designation"];
    $abbreviation =  $row["abbreviation"];
    $employment_type =  $row["employment_type"];
    $enduser_list_id =  $row["enduser_list_id"];
}


$sql = "update " . $TBL_END_USER  . " 
    set 
    date_received =UPPER('$date_received'), 
    serial_number =UPPER('$serial_number'),  
    inventory_item_number =UPPER('$inventory_item_number'), 
    enduser_list_id  =UPPER('$enduser_list_id'),
    ics_number =UPPER('$ics_number'),
    unit =UPPER('$unit'),
    designation =UPPER('$designation'),
    abbreviation =UPPER('$abbreviation'),
    employment_type =UPPER('$employment_type'),
    status =UPPER('$status')
    where enduser_id='$enduser_id' ";
$conn->query($sql) or die($conn->error);


















//QUERY FOR ITEM LOGS GET END USER 
$sqlx = "select id, end_user from " . $TBL_END_USER  . " where serial_number = '$serial_number' ";
$result = mysqli_query($conn, $sqlx);
while ($row = mysqli_fetch_array($result)) {
    $qenduser = $row["end_user"];
    $qid = $row["id"];
}


//QUERY FOR ITEM LOGS GET ENDUSER
$sqlx = "select end_user from " . $TBL_LOGS  . " where serial_number = '$serial_number' order by log_id desc ";
$result = mysqli_query($conn, $sqlx);
$row = mysqli_fetch_row($result);

$qenduser = $row[0];

// echo $qenduser . ' + ' . $end_user;

    
if (strtoupper(trim($end_user)) != strtoupper(trim($qenduser))) {
        //QUERY FOR ITEM LOGS
        $sqlnew = "insert into " . $TBL_LOGS  . "(id, serial_number, end_user, status, date_received) values(UPPER('$qid'), UPPER('$serial_number'), UPPER('$end_user'), UPPER('$status'), UPPER('$date_received'))";
        $conn->query($sqlnew) or die ($conn->error); 

        //QUERY FOR UPDATING IS_ASSIGNED
        $sqlass = "update " . $TBL_END_USER  . " 
        set 
        is_assigned =UPPER('1')
        where enduser_id='$enduser_id' ";
        $conn->query($sqlass) or die($conn->error);

        //QUERY FOR SUM OF IS_ASSIGNED
        $sqlnew1 = "
        SELECT SUM(is_assigned)
        FROM " . $TBL_END_USER  . "
        WHERE id='$qid'
        ";
        $result = mysqli_query($conn, $sqlnew1);
        while ($row = mysqli_fetch_array($result)) {
            $count = $row["SUM(is_assigned)"];
        }


        //QUERY FOR ASSIGNED FOR INVENTORY TABLE
        $sqlnew2 = "Update " . $TBL_INVENTORY . " set assigned ='$count' where id='$qid' ";
        $conn->query($sqlnew2) or die ($conn->error); 
}
else
{
    $sql_update_date_received = "update " . $TBL_LOGS  . " set date_received = UPPER('$date_received')  
    where serial_number = '$serial_number' and end_user = '$end_user' ";
    $conn->query($sql_update_date_received) or die($conn->error);
}



require_once '../phpqrcode/qrlib.php';

                $qrs = $_POST['serial_number'];
                $path = '../qrcode/';
                $file = $path.$qrs.".png";
                // $input = "NAITSIRHC"; 
                
                QRcode::png($qrs, $file, 'H', 4, 1);
                //png, input, file, ECC_LEVEL (L,M,Q,H), pixel size, frame size

                // echo "<img src='".$file."'>";