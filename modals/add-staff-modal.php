<?php
//If there's no session, start a new session
if(!isset($_SESSION))
{
    session_start();
}

include ("connections/db-connect.php");

if(isset($_POST['submitBTNstaff']))
{
    $id_no = $_POST['id_no'];
    $full_name =$_POST['full_name'];
    $designation =$_POST['designation'];
    $unit =$_POST['unit'];

    

    switch ($_POST['designation']) {
        case "EXECUTIVE DIRECTOR":
            $abbrebiation = "EXECUTIVE DIRECTOR";
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

    $sql = "insert into end_user_list_tbl(id_no,full_name,designation,unit,abbreviation,employment_type,status) 
    values(
    UPPER('$id_no'), 
    UPPER('$full_name'), 
    UPPER('$designation'),
    UPPER('$unit'),
    UPPER('$abbrebiation'),
    UPPER('$emp_type'),
    UPPER('ACTIVE'))";
    $conn->query($sql) or die ($conn->error); 

    if($conn)
    {   
        //header ('Location: staff-page.php');
    }
    else 
    {
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
    <div class="modal fade" id="add-staff-modal" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true" >
        <div class="modal-dialog modal-lg" style="top: 15%;">
            <div class="modal-content">

                <form action="" method="POST">

                        <div class="modal-header" style="background-color: #e3f2fd;">
                            <h5 class="modal-title">STAFF DETAILS</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    
                        <div class="modal-body">
                            <div class="row">
                                        <div class="col-6 mb-3">
                                            <label>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-card-text" viewBox="0 0 16 16">
                                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                            <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                                            </svg>
                                            ID No.</label>
                                            <input type="text" name="id_no" class="form-control" autocomplete="off" required>
                                        </div>

                                        <div class="col-6 mb-3">
                                            <label>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                            </svg> 
                                            Full Name</label>
                                            <input type="text" name="full_name" class="form-control" placeholder="LASTNAME,  FIRSTNAME,  MIDDLENAME" autocomplete="off" required>
                                        </div>

                                        <div class="col-6 mb-3">
                                            <label>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-person-workspace" viewBox="0 0 16 16">
                                            <path d="M4 16s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H4Zm4-5.95a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                                            <path d="M2 1a2 2 0 0 0-2 2v9.5A1.5 1.5 0 0 0 1.5 14h.653a5.373 5.373 0 0 1 1.066-2H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v9h-2.219c.554.654.89 1.373 1.066 2h.653a1.5 1.5 0 0 0 1.5-1.5V3a2 2 0 0 0-2-2H2Z"/>
                                            </svg>
                                            Designation</label>
                                            <select type="text" name="designation" class="form-select" aria-label="Default select example">
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

                                        <div class="col-6 mb-3">
                                            <label>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-person-video2" viewBox="0 0 16 16">
                                            <path d="M10 9.05a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                                            <path d="M2 1a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H2ZM1 3a1 1 0 0 1 1-1h2v2H1V3Zm4 10V2h9a1 1 0 0 1 1 1v9c0 .285-.12.543-.31.725C14.15 11.494 12.822 10 10 10c-3.037 0-4.345 1.73-4.798 3H5Zm-4-2h3v2H2a1 1 0 0 1-1-1v-1Zm3-1H1V8h3v2Zm0-3H1V5h3v2Z"/>
                                            </svg>
                                            Unit</label>
                                            <select type="unit" name="unit" class="form-select" aria-label="Default select example">
                                            <option selected>-SELECT UNIT-</option>
                                                <option value="ADFIN UNIT">ADFIN UNIT</option>
                                                <option value="OED UNIT">OED UNIT</option>
                                                <option value="BILLING UNIT">BILLING UNIT</option>
                                                <option value="ADVOC UNIT">ADVOC UNIT</option>
                                                <option value="ICT UNIT">ICT UNIT</option>
                                                <option value="PMED UNIT">PMED UNIT</option>
                                            </select>
                                        </div>

                                        

                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" name="submitBTNstaff" class="btn btn-primary" >Save</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button> 
                        </div>
                </form>

            </div>
        </div>
    </div>
</body>
</html>