<?php
include("navbar.php");
include("connections/db-connect.php");
$query = "select * from " . $TBL_INVENTORY . "";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="css/table-style.css">
</head>

    <body>
    <div class="d-flex p-2 justify-content-end">
        <button type="button" class="btn btn-secondary btn-sm justify-content-end" href="#" data-bs-toggle="modal" data-bs-target="#add-items-modal">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
        </svg>
        Add Items
        </button> 
    </div>
        <div class="container-fluid px-2" style="background-color:#e3f2fd; border-radius: 18px;">
            <div class="row py-2">
                <div class="col">
                    <div class="table table-responsive">
                        <table id="table1" class="table table-striped" style="font-size:15px">
                        <h3 align="Center">
                            LIST OF ALL ITEMS
                        </h3>
                            <thead>
                                <tr>
                                    <th style="width:3%; text-align:center">Inventory No.</th>
                                    <th style="width:11%">Item</th>
                                    <th style="width:12%">MR to</th>
                                    <th style="width:3%">Unit</th>
                                    <th style="width:3%">Assigned</th>
                                    <th style="width:3%">Quantity</th>
                                    <th style="width:6%">Unit Cost</th>
                                    <th style="width:5%">Total Cost</th>
                                    <th style="width:6%; text-align:center">Date Acquired by CHED</th>
                                    <th style="width:9%">Actions</th>
                                </tr>
                            </thead
                            <tbody>
                                <?php
                                $num = 0;
                                while ($row = mysqli_fetch_array($result)) :

                                    $item = $row["item"];
                                    $assigned = $row["assigned"];
                                    $itemdescription = $row["item_description"];
                                    $supplier = $row["supplier"];
                                    $quantity = $row["quantity"];
                                    $unitcost = $row["unit_cost"];
                                    $unit = $row["unit"];
                                    $dateacquired = $row["date_acquired"];

                                    $totalcost = $quantity * $unitcost;
                                    setlocale(LC_MONETARY, 'en_US');
                                    
                                ?>
                                    <tr>
                                        <td id="item0"><?= $row["id"] ?></td>
                                        <td id="item1"><?= $item ?></td>
                                        <td id="item2"><?= $row["received_by"]  ?></td>
                                        <td id="item4"><?= $unit ?></td>
                                        <td id="item6"><?= $assigned ?></td>
                                        <td id="item3"><?= $quantity ?></td>
                                        <td>₱ <?= number_format($unitcost, 0); ?></td>
                                        <td>₱ <?= number_format($totalcost, 0); ?></td>
                                        <td id="date_inventory_items"><?= $dateacquired ?></td>
                                        <td>
                                            <button id="btnid" type="button" value="  <?= $row["id"] ?>  " class="btn btn-primary btn-sm view">End users</button>
                                            <button type="button" value="  <?= $row["id"] ?>  " class="btn btn-success btn-sm update">Update</button>
                                        </td>
                                    </tr>
                                <?php
                                endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
         -->
        <!-- <script>
        $(document).ready(function() {
            $('#date_inventory_items').toDateString();
        });
        </script> -->

    </body>
</html>