<?php
//If there's no session, start a new session
if (!isset($_SESSION)) {
    session_start();
}

//include database
include("connections/db-connect.php");
include("modals/end-user-modal.php");


//query for fetching in table
$sql = "select full_name from " . $TBL_UNIFAST_STAFF  . " order by full_name asc";
$result = $conn->query($sql);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/select2.css" rel="stylesheet">
</head>

<body>

    <div class="wrapper" id="wrapper" style=" position:absolute;left:350px; top:50px;display:none; z-index: 9999;">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Warning!</strong> Changing the status into "RETURNED TO CHED" will remove the assigned end user.
            <button type="button" class="btn-close closealert"></button>
        </div>
    </div>


    <div class="modal" id="update-enduser-modal" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true" data-bs-backdrop="false">
        <div class="modal-dialog modal-md" style="top: 15%; ">
            <div class="modal-content">


                <form id="update_user_form">
                    <div class="modal-header" style="background-color: #e3f2fd;">
                        <h5 class="modal-title">EDIT ITEM DETAILS AND END USER</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>


                    <div class="modal-body">

                        <div class="row">
                            <input name="enduser_id" id="enduser_id" type="hidden">

                            <div class="col-6 mb-3">
                                <label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-handbag" viewBox="0 0 18 22">
                                        <path d="M8 1a2 2 0 0 1 2 2v2H6V3a2 2 0 0 1 2-2zm3 4V3a3 3 0 1 0-6 0v2H3.36a1.5 1.5 0 0 0-1.483 1.277L.85 13.13A2.5 2.5 0 0 0 3.322 16h9.355a2.5 2.5 0 0 0 2.473-2.87l-1.028-6.853A1.5 1.5 0 0 0 12.64 5H11zm-1 1v1.5a.5.5 0 0 0 1 0V6h1.639a.5.5 0 0 1 .494.426l1.028 6.851A1.5 1.5 0 0 1 12.678 15H3.322a1.5 1.5 0 0 1-1.483-1.723l1.028-6.851A.5.5 0 0 1 3.36 6H5v1.5a.5.5 0 1 0 1 0V6h4z" />
                                    </svg>
                                    Serial Number</label>
                                <div class="d-flex justify-content-left">
                                    <input type="text" name="serial_number" id="serial_number" class="form-control" autocomplete="off" style="width: 190px; display:flex;" required>
                                    <div id="generateserial" class="generateserial btn btn-secondary" style="padding:2px; width: 32px; font-size:14px; font-weight:500; text-align: left;">N/A</div>
                                </div>

                            </div>

                            <div class="col-6 mb-3">
                                <label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-file-earmark-text" viewBox="0 0 18 22">
                                        <path d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z" />
                                        <path d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5L9.5 0zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                                    </svg>
                                    Inventory Item Number</label>
                                <input type="text" name="inventory_item_number" id="inventory_item_number" class="form-control" autocomplete="off" required>
                            </div>

                            <div class="col-6">
                                <label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-upc-scan" viewBox="0 0 16 16">
                                        <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5zM3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-7zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7z" />
                                    </svg>
                                    ICS Number</label>
                                <input type="text" name="ics_number" id="ics_number" class="form-control" autocomplete="off" required>
                            </div>

                            <div class="col-6 mb-3">
                                <label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-person-check" viewBox="0 0 16 16">
                                        <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                        <path fill-rule="evenodd" d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                    </svg>
                                    Status</label>
                                <select id="status" name="status" class="form-select selectitemstatus" aria-label="Default select example">
                                    <!-- <option selected>-SELECT STATUS-</option> -->
                                    <option value="GOOD CONDITION">GOOD CONDITION</option>
                                    <option value="DAMAGED">DAMAGED</option>
                                    <option value="REPAIRED">REPAIRED</option>
                                    <optgroup label="MISSING TYPE">
                                        <option value="MISSING">MISSING</option>
                                        <option value="MISSING-PAID">MISSING-PAID</option>
                                        <option value="MISSING-REPLACED">MISSING-REPLACED</option>
                                    </optgroup>
                                    <option class="itemstatus" value="RETURNED TO CHED">RETURNED TO CHED</option>
                                </select>
                            </div>

                            <div class="col-6 mb-3">
                                <label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-person-check" viewBox="0 0 16 16">
                                        <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                        <path fill-rule="evenodd" d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                    </svg>
                                    End User</label>
                                <select id="end_user" name="end_user">
                                    <?php
                                    // $sql1 = "";
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $name = $row["full_name"];
                                            echo "<option value='" . $name  . "'>" . $name  . " </option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-6 mb-3">
                                <label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-calendar-check" viewBox="0 0 18 22">
                                        <path d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                                    </svg>
                                    Date Received</label>
                                <input type="date" name="date_received" id="date_received" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" id="btn_done_useredit" name="submitBTNN" value="" class="btn btn-success updatesubmit">Done</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>

            </div>
        </div>
    </div>




</body>

</html>