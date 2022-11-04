<?php
//If there's no session, start a new session
if(!isset($_SESSION))
{
    session_start();
}

include ("connections/db-connect.php");

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
    <div class="modal fade" id="mr-report-modal" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true" >
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <form action="" method="POST">

                        <div class="modal-header" style="background-color: #e3f2fd;">
                            <h5 class="modal-title">REQUISITIONED ITEMS OF UNIFAST OFFICIAL</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-10">
                                <select type="text" id="selectplantilla"  name="unit" class="form-select selectplantilla" aria-label="Default select example" style="width: 270px; margin-left:2px">
                                    <option>--SELECT PLANTILLA POSITION--</option>    
                                    <?php
                                    $sqlplantilla = "select full_name from end_user_list_tbl where employment_type = 'PLANTILLA' order by full_name asc";
                                    $result = $conn->query($sqlplantilla);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $name = $row["full_name"];
                                            echo "<option value='" . $name  . "'>" . $name  . " </option>";
                                        }
                                    }
                                    ?>
                                    <!-- <option value="ESTEVEZ, RYAN L.">ESTEVEZ, RYAN L.</option>
                                    <option value="AMPIL, MA. CLARA A.">AMPIL, MA. CLARA A.</option>
                                    <option value="CHAN, PRECILA A.">CHAN, PRECILA A.</option>
                                    <option value="GANDO, ANNALIZA A.">GANDO, ANNALIZA A.</option>
                                    <option value="TOQUE, RODERICK V.">TOQUE, RODERICK V.</option> -->
                                </select> 
                                &nbsp;<label style="font-size:16px">DESIGNATION: </label> &nbsp;&nbsp;<label style="font-size:16px" id="plantillaposition"></label> <br>
                                &nbsp;<label style="font-size:16px">UNIT:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:16px;" id="plantillaunit"></label> <br>

                                    <label style="font-size:16px">TOTAL ITEMS: </label> &nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:16px" id="totalitemsmr"></label>  <br>
                                    <label style="font-size:16px">TOTAL COST: </label> <label style="font-size:16px;"></label> &nbsp;&nbsp;&nbsp;&nbsp;<label id="pesosign" style="font-size:16px"></label> <label style="font-size:16px" id="totalcostmrd"></label>  <br>
                                </div>
                                <div class="col-2">
                                    <a id='btn_pdf4' class="btn btn-danger btn-sm" target="_blank"  style="font-size:14px; width: 100%;" role="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z"/>
                                    </svg>
                                    Generate PDF</a>
                                </div>
                            </div>
                            <hr>
                                
                                <div>
                                    <table id="table-unit-reports" class="table table-striped" style="font-size:14px">
                                        <thead>
                                            <tr>
                                                <th style="width:4%; text-align:center">No.</th>
                                                <th style="width:14%; text-align:center">Item</th>   
                                                <th style="width:20%; text-align:center">Item Description</th>
                                                <th style="text-align:center">Quantity</th>
                                                <th style="text-align:center">Assigned</th>
                                                <th style="text-align:center">Unit Cost</th>
                                                <th style="text-align:center">Total Cost</th>
                                                <th style="text-align:center">Date Acquired</th>
                                                <th style="text-align:center">Warranty</th>
                                            </tr>   
                                        </thead>
                                        <tbody id="table-body-mr-reports">
                                        </tbody>
                                    </table>
                                </div>
                           
                        </div>
                </form>

            </div>
        </div>
    </div>
</body>
</html>