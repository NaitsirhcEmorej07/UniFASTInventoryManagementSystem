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
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css"> -->

    <style>
    </style>
</head>

<body>
    <div class="modal fade" id="end-user-modal" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <form action="" method="POST" id="enduserform">

                    <div class="modal-header" style="background-color: #e3f2fd;">
                        <h5 class="modal-title">ITEM DETAILS</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <input type="hidden" name="" id="modal_id">

                    <div class="modal-body" id="endusermodalid">
                        <div class="row">
                            <div class="col-10">
                                <label id="desc1" style="font-weight:600; font-size:16px;">??????</label><br>
                                <label style="font-size:14px; font-weight:500;">DESCRIPTION:</label>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;<label id="desc2" style="font-size:14px;">??????</label> <br>
                                <label style="font-size:14px; font-weight:500;">DATE ACQUIRED: </label>&nbsp;&nbsp;&nbsp;<label id="dateacquired" style="font-size:14px;">??????</label> <br>
                                <label style="font-size:14px; font-weight:500;">SUPPLIER:</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label id="desc5" style="font-size:14px;">??????</label> <br>
                                <label style="font-size:14px; font-weight:500;">WARRANTY: </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label id="warranty" style="font-size:14px;">??????</label><br>
                                <label style="font-size:14px; font-weight:500;">QUANTITY: </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label id="desc3" style="font-size:14px;">??????</label> <label id="desc4" style="font-size:14px;">??????</label>
                            </div>

                            <div class="col-2 p-4">
                                <!-- <a class="btn btn-warning btn-sm generateqrcode mb-1" style="font-size:14px; width: 100%;" role="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-qr-code" viewBox="0 0 16 16">
                                    <path d="M2 2h2v2H2V2Z"/>
                                    <path d="M6 0v6H0V0h6ZM5 1H1v4h4V1ZM4 12H2v2h2v-2Z"/>
                                    <path d="M6 10v6H0v-6h6Zm-5 1v4h4v-4H1Zm11-9h2v2h-2V2Z"/>
                                    <path d="M10 0v6h6V0h-6Zm5 1v4h-4V1h4ZM8 1V0h1v2H8v2H7V1h1Zm0 5V4h1v2H8ZM6 8V7h1V6h1v2h1V7h5v1h-4v1H7V8H6Zm0 0v1H2V8H1v1H0V7h3v1h3Zm10 1h-1V7h1v2Zm-1 0h-1v2h2v-1h-1V9Zm-4 0h2v1h-1v1h-1V9Zm2 3v-1h-1v1h-1v1H9v1h3v-2h1Zm0 0h3v1h-2v1h-1v-2Zm-4-1v1h1v-2H7v1h2Z"/>
                                    <path d="M7 12h1v3h4v1H7v-4Zm9 2v2h-3v-1h2v-1h1Z"/>
                                    </svg>
                                    Generate QR</a> -->
                                <input name="generateqr" id="generateqr" type="hidden">


                                <a id='btn_pdf2' class="btn btn-danger btn-sm generatepdf" target="_blank" style="font-size:14px; width: 100%;" role="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z" />
                                    </svg>
                                    Generate PDF</a>
                                <input name="generate_pdf" id="generate_pdf" type="hidden">
                            </div>
                        </div>
                        <hr>
                        <div id="resettable" class="row">
                            <div class="col-sm-12">
                                <!-- style="width: 100%;" for datatables -->
                                <table id="table2" class="table table-hover table-striped table-responsive" style="font-size: 14px;">
                                    <thead>
                                        <tr>
                                            <td style="width:3%">No.</td>
                                            <td style="width:12%; text-align:center;">Serial Number</td>
                                            <td style="width:10%; text-align:center;">Inventory Item Number</td>
                                            <td style="width:10%; text-align:center;">ICS Number</td>
                                            <td style="width:13%">Status</td>
                                            <td>MR To</td>
                                            <td>End User</td>
                                            <td style="width:9%">Date Received</td>
                                            <td style="width:12%">Action</td>
                                        </tr>
                                    </thead>

                                    <tbody id='testing'>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script> -->

    <!-- <script>
        $(document).ready(function() {
            $('#table2').DataTable();
        });
    </script> -->



</body>

</html>