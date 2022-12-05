<?php
include("navbar.php");
include("connections/db-connect.php");
$query = "select * from " . $TBL_UNIFAST_STAFF  . " order by status , full_name ASC";
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
        <button type="button" class="btn btn-secondary btn-sm justify-content-end" href="#" data-bs-toggle="modal" data-bs-target="#add-staff-modal">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
            </svg>
            Add Staff
        </button> &nbsp;

        <button type="button" class="btn btn-secondary btn-sm justify-content-end" href="pdf4.php" data-bs-toggle="modal" data-bs-target="#mr-report-modal">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-person-video2" viewBox="0 0 16 16">
                <path d="M10 9.05a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                <path d="M2 1a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H2ZM1 3a1 1 0 0 1 1-1h2v2H1V3Zm4 10V2h9a1 1 0 0 1 1 1v9c0 .285-.12.543-.31.725C14.15 11.494 12.822 10 10 10c-3.037 0-4.345 1.73-4.798 3H5Zm-4-2h3v2H2a1 1 0 0 1-1-1v-1Zm3-1H1V8h3v2Zm0-3H1V5h3v2Z" />
            </svg></svg>
            MR Reports
        </button>
    </div>

    <div class="container-fluid p-2" style="background-color:#e3f2fd; border-radius: 18px;">
        <div class="row py-2">
            <div class="col">
                <div class="table table-responsive">
                    <table id="table_staff" class="table table-striped" style="font-size: 15px;">
                        <h3 align="Center">
                            LIST OF UNIFAST STAFF
                        </h3>
                        <thead>
                            <tr>
                                <th style="width:4%;">No.</th>
                                <th style="width:7%">ID No.</th>
                                <th style="width:16%">Full Name</th>
                                <th>Designation</th>
                                <th style="width:10%">Employment Type</th>
                                <th style="width:7%">Unit</th>
                                <th style="width:6%">Status</th>
                                <th style="width:11%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $x = 0;
                            while ($row = mysqli_fetch_array($result)) :
                                $enduser_list_id = $row["enduser_list_id"];

                                $staff_first_name = $row["first_name"];
                                $staff_middle_name = $row["middle_name"];
                                $staff_last_name = $row["last_name"];
                                $staff_prefix_name = $row["prefix"];
                                $staff_suffix_name = $row["suffix"];
                                $staff_title_name = $row["title"];

                                if ($staff_prefix_name == "N/A" || $staff_prefix_name == "") {
                                    $staff_prefix_name = "";
                                }
                                if ($staff_suffix_name == "N/A" || $staff_suffix_name == "") {
                                    $staff_suffix_name = "";
                                }
                                if ($staff_title_name == "N/A"|| $staff_title_name == "") {
                                    $staff_title_name = "";
                                }
                                if ($staff_middle_name == "N/A"|| $staff_middle_name == "") {
                                    $staff_middle_name = "";
                                }
                                


                                $show_full_name = $staff_prefix_name." ".$staff_last_name.", ".$staff_first_name." ".$staff_middle_name." ".$staff_suffix_name.", ".$staff_title_name;
                                $id_no = $row["id_no"];
                                $full_name = $row["full_name"];
                                $designation = $row["designation"];
                                $emp_type = $row["employment_type"];
                                $unit = $row["unit"];
                                $status = $row["status"];
                                $x++;
                                // $x = $rowcount=mysqli_num_rows($result);
                            ?>
                                <tr>
                                    <td> <?=$x?></td>
                                    <td><?=$id_no?></td>
                                    <td id="item3"><?=$show_full_name?></td>
                                    <td id="item4"><?=$designation?></td>
                                    <td id="emp_type"><?=$emp_type?></td>
                                    <td id="item5"><?=$unit?></td>
                                    <td><?=$status?></td>
                                    <td>
                                        <button type="button" value="<?= $enduser_list_id ?>" class="btn btn-success btn-sm viewstaff">Update</button>
                                        <button type="button" value="<?= $enduser_list_id ?>" class="btn btn-info btn-sm viewstaffitems" id="<?= $enduser_list_id ?>" href="#" data-bs-toggle="modal" data-bs-target="#staff-items-modal">View Items</button>
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
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script> -->

</body>

</html>