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
    <div class="modal fade" id="unit-reports-modal" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true" >
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                        <div class="modal-header" style="background-color: #e3f2fd;">
                            <h5 class="modal-title" id="unitsheader">UNIT REPORTS</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    
                        <div class="modal-body">
                                <input type="hidden" id="hiddenunit">
                                <div class="row">
                                    <div class="col-8">
                                        <label style="font-weight:600; font-size:18px;" id="showunit">??????</label>&nbsp; <br>
                                        <label style="font-weight:600; font-size:16px;">TOTAL ITEMS:</label>&nbsp;<label style="font-size:16px;" id="totalitemsunit">------</label> <br>
                                        <label style="font-weight:600; font-size:16px;">TOTAL COST :</label>&nbsp;<label style="font-size:16px;">₱&nbsp; </label><label style="font-size:16px;" id="totalcostunit">------</label> 
                                    </div>
                                    <div class="col-4 mb-5 d-flex justify-content-end">
                                        <a id='btn_pdf3' class="btn btn-danger btn-sm generatepdf3" target="_blank" href="request\select_fetch_table_units_pdf.php?unit=" style="font-size:14px;" role="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z"/>
                                        </svg>
                                        Generate PDF</a>
                                    </div>
                                    <div class="class">
                                        <table id="table-unit-reports" class="table table-striped" style="font-size: 14px;">
                                            <thead>
                                                <tr>
                                                    <th style="width: 3%;">No.</th>
                                                    <th style="width: 16%;">Position</th>
                                                    <th style="width: 16%;">End User</th>
                                                    <th style="width: 11%;">Date Received</th>
                                                    <th style="width: 15%;">Item</th>
                                                    <th style="width: 17%;">Item Description</th>
                                                    <th style="width: 10%;">Serial Number</th>
                                                    <th style="width: 7%;">Unit Cost</th>
                                                </tr>   
                                            </thead>
                                            <tbody id="table-body-unit-reports">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                        </div>

            </div>
        </div>
    </div>
    
    <script type="text/javascript">
                $(document).ready(function() 
                {
                    //  $('#table-unit-reports').DataTable();
                });
    </script>

        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

</body>
</html>