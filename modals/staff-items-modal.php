<?php
//If there's no session, start a new session
if (!isset($_SESSION)) {
    session_start();
}

include("connections/db-connect.php");
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
    <div class="modal fade" id="staff-items-modal" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <form action="" method="POST">

                    <div class="modal-header" style="background-color: #e3f2fd;">
                        <h5 class="modal-title">STAFF ITEMS</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <input name="endusernameid" id="endusernameid" type="hidden">

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-10">
                                <label style="font-size:16px; font-weight:500">NAME:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:16px" id="enduser">......</label> <br>
                                <label style="font-size:14px; font-weight:500">DESIGNATION:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:14px" id="position">......</label> <br>
                                <label style="font-size:14px; font-weight:500">UNIT: </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:14px" id="unit1">......</label> <br>
                                <label style="font-size:14px; font-weight:500">TOTAL ITEMS: </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label id="stafftotalitems" style="font-size:14px; ">------</label> <br>
                                <label style="font-size:14px; font-weight:500">TOTAL COST: </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label style="font-size:14px;">???</label>&nbsp;<label id="stafftotalcost" style="font-size:14px; ">------</label>
                                
                            </div>
                            <div class="col-2">
                                <a id='btn_pdf' class="btn btn-danger btn-sm" target="_blank" href="request\select_fetch_table_enduser_items_pdf.php?itm1=" style="font-size:14px; width: 100%;" role="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z" />
                                    </svg>
                                    Generate PDF</a>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <table id="tablestaffitems" class="table table-striped" style="width: 100%; font-size:14px;">
                                    <thead>
                                        <tr>
                                            <td style="width:3%; text-align:left;">No.</td>
                                            <td style="width:17%; text-align:left;">Item</td>
                                            <td style="width:25%; text-align:left;">Item Description</td>
                                            <td style="width:16%;">MR to</td>
                                            <td style="width:12%;">Date Received</td>
                                            <td style="width:16%; text-align:center;">Warranty</td>
                                            <td style="width:16%; text-align:center;">Serial Number</td>
                                            <td style="width:12%; text-align:center;" id="unitcost">Unit Cost</td>
                                        </tr>
                                    </thead>
                                    <tbody id="tablestaffitemsbody">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>

</html>