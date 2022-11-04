<?php
include("navbar.php");
include("connections/db-connect.php");

$sql = "select
" . $TBL_INVENTORY . ".item, 
" . $TBL_LOGS  . ".serial_number, 
" . $TBL_LOGS  . ".end_user,
" . $TBL_LOGS  . ".status,
" . $TBL_LOGS  . ".date_received


FROM " . $TBL_INVENTORY . "
INNER JOIN " . $TBL_LOGS  . " ON " . $TBL_INVENTORY . ".id=" . $TBL_LOGS  . ".id order by date_received DESC";
$result = mysqli_query($conn, $sql);



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/table-style.css">
</head>

    <body>
        <div class="container p-2 mt-5" style="background-color:#e3f2fd; border-radius: 18px; width: 75%;">
            <h3 align="Center">ITEM LOGS</h3>
            <div class="row">
                <div class="col">
                    <table id="table1" class="table table-responsive table-striped">
                        <thead>
                            <tr>
                                <th>ITEM</th>
                                <th>SERIAL NUMBER</th>
                                <th>END USER</th>
                                <th>STATUS</th>
                                <th>DATE RECEIVED</th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php
                                $num = 0;
                                while ($row = mysqli_fetch_array($result)) :

                                    $item = $row["item"];
                                    $serial_number = $row["serial_number"];
                                    $end_user = $row["end_user"];
                                    $status= $row["status"];
                                    $date_received = $row["date_received"];

                                ?>
                            <tr>
                                <td><?= $item ?></td>
                                <td><?= $serial_number ?></td>
                                <td><?= $end_user ?></td>
                                <td><?= $status ?></td>
                                <td><?= $date_received ?></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
    

        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    </body>
</html>