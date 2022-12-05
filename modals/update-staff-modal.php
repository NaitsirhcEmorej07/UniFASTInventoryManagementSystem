<?php
//If there's no session, start a new session
if (!isset($_SESSION)) {
    session_start();
}

include("connections/db-connect.php");

if (isset($_POST['submitstaffBTN'])) {
    $enduserid = $_POST['enduserid'];
    $id_no = $_POST['id_no'];
    $full_name = $_POST['full_name'];
    $designation = $_POST['designation'];
    $unit = $_POST['unit'];
    $staff_first_name = $_POST['staff_first_name'];
    $staff_middle_name = $_POST['staff_middle_name'];
    $staff_last_name = $_POST['staff_last_name'];
    $staff_prefix_name = $_POST['staff_prefix_name'];
    $staff_suffix_name = $_POST['staff_suffix_name'];
    $staff_title_name = $_POST['staff_title_name'];
    $statusstaff = $_POST['statusstaff'];

    switch ($_POST['designation']) {
        case "EXECUTIVE DIRECTOR":
            $abbrebiation = "ED";
            $emp_type = "PLANTILLA";
            break;
        case "SUPERVISING EDUCATION PROGRAM SPECIALIST":
            $abbrebiation = "SEPS";
            $emp_type = "PLANTILLA";
            break;
        case "EXECUTIVE ASSISTANT III":
            $abbrebiation = "EA III";
            $emp_type = "PLANTILLA";
            break;
        case "ADMINISTRATIVE ASSISTANT III":
            $abbrebiation = "AA III";
            $emp_type = "PLANTILLA";
            break;
        case "PROJECT TECHNICAL STAFF I":
            $abbrebiation = "PTS I";
            $emp_type = "COS";
            break;
        case "PROJECT TECHNICAL STAFF II":
            $abbrebiation = "PTS II";
            $emp_type = "COS";
            break;
        case "PROJECT TECHNICAL STAFF III":
            $abbrebiation = "PTS III";
            $emp_type = "COS";
            break;
        default:
            $abbrebiation = "NO RECORD";
            $emp_type = "NO RECORD";
    }

    $sql = "update " . $TBL_UNIFAST_STAFF  . " set 
    id_no = UPPER('$id_no'), 
    first_name = UPPER('$staff_first_name'), 
    last_name = UPPER('$staff_last_name'), 
    middle_name= UPPER('$staff_middle_name'), 
    prefix= UPPER('$staff_prefix_name'), 
    suffix = UPPER('$staff_suffix_name'), 
    title= UPPER('$staff_title_name'), 
    full_name = UPPER('$full_name'), 
    designation = UPPER('$designation'),
    abbreviation = UPPER('$abbrebiation'),
    employment_type=UPPER('$emp_type'),
    status = UPPER('$statusstaff'),
    unit = UPPER('$unit')
    where enduser_list_id = '$enduserid' ";

    $conn->query($sql) or die($conn->error);


    $sql1 = "
    update " . $TBL_END_USER  . " set 
    unit=UPPER('$unit'),
    designation=UPPER('$designation'),
    abbreviation=UPPER('$abbrebiation'),
    employment_type=UPPER('$emp_type')
    where enduser_list_id = '$enduserid'
    ";
    $conn->query($sql1) or die($conn->error);


    if ($conn) {
        // header ('Location: staff-page.php');
    } else {
        echo '<script> alert("Data Not Saved!"); </script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="modal fade" id="update-staff-modal" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="top: 15%;">
            <div class="modal-content">

                <form action="" method="POST">

                    <div class="modal-header" style="background-color: #e3f2fd;">
                        <h5 class="modal-title">UPDATE STAFF DETAILS</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <input name="enduserid" id="enduserid" type="hidden">

                    <div class="modal-body">
                        <div class="row">

                        <div class="col-4">
                                <label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                    </svg>
                                    FIRST NAME
                                </label>
                                <input type="text" name="staff_first_name" id="staff_first_name" class="form-control" placeholder="FIRST NAME" autocomplete="off">
                            </div>

                            <div class="col-4">
                                <label>
                                    MIDDLE NAME
                                </label>
                                <input type="text" name="staff_middle_name" id="staff_middle_name" class="form-control" placeholder="MIDDLE NAME" autocomplete="off">
                            </div>

                            <div class="col-4 mb-4">
                                <label>
                                    LAST NAME
                                </label>
                                <input type="text" name="staff_last_name" id="staff_last_name" class="form-control" placeholder="LAST NAME" autocomplete="off">
                            </div>

                            <div class="col-4">
                                <label>
                                    PREFIX
                                </label>
                                <input type="text" name="staff_prefix_name" id="staff_prefix_name" class="form-control" placeholder="PREFIX" autocomplete="off">
                            </div>

                            <div class="col-4">
                                <label>
                                    SUFFIX
                                </label>
                                <select type="unit" name="staff_suffix_name" id="staff_suffix_name" class="form-select" aria-label="Default select example">
                                    <option selected>-SELECT SUFFIX-</option>
                                    <option value="N/A">N/A</option>
                                    <option value="JR.">JR.</option>
                                    <option value="SR.">SR.</option>
                                </select>
                            </div>

                            <div class="col-4 mb-4">
                                <label>
                                    TITLE
                                </label>
                                <input type="text" name="staff_title_name" id="staff_title_name" class="form-control" placeholder="TITLE" autocomplete="off">
                            </div>

                            <div class="col-4 mb-3">
                                <label class="p-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-card-text" viewBox="0 0 16 16">
                                        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                                        <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z" />
                                    </svg>
                                    ID NO.</label>
                                <input type="text" name="id_no" id="id_no" class="form-control" required>
                            </div>

                            <div class="col-4 mb-3" >
                                <label class="p-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                                    </svg>
                                    Full Name</label>
                                <input type="text" name="full_name" id="full_name" class="form-control" readonly>
                            </div>

                            <div class="col-4 mb-3">
                                <label class="p-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-person-workspace" viewBox="0 0 16 16">
                                        <path d="M4 16s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H4Zm4-5.95a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                                        <path d="M2 1a2 2 0 0 0-2 2v9.5A1.5 1.5 0 0 0 1.5 14h.653a5.373 5.373 0 0 1 1.066-2H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v9h-2.219c.554.654.89 1.373 1.066 2h.653a1.5 1.5 0 0 0 1.5-1.5V3a2 2 0 0 0-2-2H2Z" />
                                    </svg>
                                    Designation</label>
                                <select type="text" id="designation" name="designation" class="form-select" aria-label="Default select example">
                                    <option selected>-SELECT DESIGNATION-</option>
                                    <option value="EXECUTIVE DIRECTOR">EXECUTIVE DIRECTOR</option>
                                    <option value="SUPERVISING EDUCATION PROGRAM SPECIALIST">SUPERVISING EDUCATION PROGRAM SPECIALIST</option>
                                    <option value="EXECUTIVE ASSISTANT III">EXECUTIVE ASSISTANT III</option>
                                    <option value="ADMINISTRATIVE ASSISTANT III">ADMINISTRATIVE ASSISTANT III</option>
                                    <option value="PROJECT TECHNICAL STAFF I">PROJECT TECHNICAL STAFF I</option>
                                    <option value="PROJECT TECHNICAL STAFF II">PROJECT TECHNICAL STAFF II</option>
                                    <option value="PROJECT TECHNICAL STAFF III">PROJECT TECHNICAL STAFF III</option>
                                </select>
                            </div>

                            <div class="col-4 mb-3">
                                <label class="p-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-person-video2" viewBox="0 0 16 16">
                                        <path d="M10 9.05a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                                        <path d="M2 1a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H2ZM1 3a1 1 0 0 1 1-1h2v2H1V3Zm4 10V2h9a1 1 0 0 1 1 1v9c0 .285-.12.543-.31.725C14.15 11.494 12.822 10 10 10c-3.037 0-4.345 1.73-4.798 3H5Zm-4-2h3v2H2a1 1 0 0 1-1-1v-1Zm3-1H1V8h3v2Zm0-3H1V5h3v2Z" />
                                    </svg>
                                    Unit</label>
                                <select name="unit" id="unit" class="form-select" aria-label="Default select example">
                                    <option selected>-SELECT UNIT-</option>
                                    <option value="ADFIN UNIT">ADFIN UNIT</option>
                                    <option value="OED UNIT">OED UNIT</option>
                                    <option value="BILLING UNIT">BILLING UNIT</option>
                                    <option value="ADVOC UNIT">ADVOC UNIT</option>
                                    <option value="ICT UNIT">ICT UNIT</option>
                                    <option value="PMED UNIT">PMED UNIT</option>
                                </select>
                            </div>

                            <div class="col-4 mb-3">
                                <label class="p-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-patch-check" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M10.354 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                        <path d="m10.273 2.513-.921-.944.715-.698.622.637.89-.011a2.89 2.89 0 0 1 2.924 2.924l-.01.89.636.622a2.89 2.89 0 0 1 0 4.134l-.637.622.011.89a2.89 2.89 0 0 1-2.924 2.924l-.89-.01-.622.636a2.89 2.89 0 0 1-4.134 0l-.622-.637-.89.011a2.89 2.89 0 0 1-2.924-2.924l.01-.89-.636-.622a2.89 2.89 0 0 1 0-4.134l.637-.622-.011-.89a2.89 2.89 0 0 1 2.924-2.924l.89.01.622-.636a2.89 2.89 0 0 1 4.134 0l-.715.698a1.89 1.89 0 0 0-2.704 0l-.92.944-1.32-.016a1.89 1.89 0 0 0-1.911 1.912l.016 1.318-.944.921a1.89 1.89 0 0 0 0 2.704l.944.92-.016 1.32a1.89 1.89 0 0 0 1.912 1.911l1.318-.016.921.944a1.89 1.89 0 0 0 2.704 0l.92-.944 1.32.016a1.89 1.89 0 0 0 1.911-1.912l-.016-1.318.944-.921a1.89 1.89 0 0 0 0-2.704l-.944-.92.016-1.32a1.89 1.89 0 0 0-1.912-1.911l-1.318.016z" />
                                    </svg>
                                    Status</label>
                                <select name="statusstaff" id="statusstaff" class="form-select" aria-label="Default select example">
                                    <option selected>-SELECT STATUS-</option>
                                    <option value="ACTIVE">ACTIVE</option>
                                    <option value="INACTIVE">INACTIVE</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" name="submitstaffBTN" class="btn btn-success">Done</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>

</html>