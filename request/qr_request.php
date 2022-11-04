
<?php
session_start();
include_once '../connections/db-connect.php';

if (isset($_POST["inventoryid"])) {

    $query = "select serial_number from end_user_tbl where id='".$_POST["inventoryid"]."' ";
    $result = mysqli_query($conn, $query);

    while($row = mysqli_fetch_array($result))
    {

        $rows[] =  $row["serial_number"];

    }

            foreach($rows as $qrs)
            {
                require_once '../phpqrcode/qrlib.php';

                $path = '../qrcode/';
                $file = $path.$qrs.".png";
                // $input = "NAITSIRHC"; 
                
                QRcode::png($qrs, $file, 'H', 4, 1);
                //png, input, file, ECC_LEVEL (L,M,Q,H), pixel size, frame size

                // echo "<img src='".$file."'>";
            }

    
}