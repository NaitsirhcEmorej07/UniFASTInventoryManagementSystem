<?php
include ("navbar.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
</head>
<body>
 
    <div class="container-fluid mt-3 py-3">
        <div class="row">
            <div class="col-3 my-3 d-flex align-items-stretch">
                <div class="card text-white bg-primary mb-3" style="width: 18rem;">
                <div class="card-header">UNIFAST ITEMS</div>
                <div class="card-body">
                    <h5 class="card-title">TOTAL NUMBER OF PROCURED ITEMS</h5>
                    <p class="card-text"><h1>300<h1></p>
                </div>
                </div>
            </div>
            <div class="col-3 my-3 d-flex align-items-stretch">
                <div class="card text-white bg-success mb-3" style="width: 18rem;">
                <div class="card-header">ASSIGNED ITEMS</div>
                <div class="card-body">
                    <h5 class="card-title">TOTAL NUMBER OF ASSIGNED ITEMS</h5>
                    <p class="card-text"><h1>220<h1></p>
                </div>
                </div>
            </div>
            <div class="col-3 my-3 d-flex align-items-stretch">
                <div class="card text-dark bg-warning mb-3" style="width: 18rem;">
                <div class="card-header">UNASSIGNED ITEMS</div>
                <div class="card-body">
                    <h5 class="card-title">TOTAL NUMBER OF UNASSIGNED ITEMS</h5>
                    <p class="card-text"><h1>70<h1></p>
                </div>
                </div>
            </div>
            <div class="col-3 my-3 d-flex align-items-stretch">
                <div class="card text-dark bg-light mb-3" style="width: 18rem;">
                <div class="card-header">DAMAGED AND MISSING ITEMS</div>
                <div class="card-body">
                    <class class="row">
                        <div class="col-9">
                            <h5 class="card-text">TOTAL NUMBER OF DAMAGED ITEMS</h5>
                        </div>
                        <div class="col-3">
                            <p class="card-text"><h2>10<h2></p>
                        </div>
                        <div class="col-9">
                            <h5 class="card-text">TOTAL NUMBER OF MISSING ITEMS</h5>
                        </div>
                        <div class="col-3">
                            <p class="card-text"><h2>5<h2></p>
                        </div>
                    </class>
                </div>
                </div>
            </div>
            <!-- <div class="col-3 my-3 d-flex align-items-stretch">
                <div class="card text-light bg-secondary mb-3" style="width: 18rem; height: 16rem;">
                <div class="card-header">ASSIGNED ITEMS PER UNIT</div>
                <div class="card-body">
                    <p class="card-text">
                    <select class="form-select" aria-label="Default select example">
                    <option selected>--SELECT UNIT--</option>
                    <option value="OED UNIT">OED UNIT</option>
                    <option value="ADFIN UNIT">ADFIN UNIT</option>
                    <option value="ADVOC UNIT">ADVOC UNIT</option>
                    <option value="BILLING UNIT">BILLING UNIT</option>
                    <option value="PMED UNIT">PMED UNIT</option>
                    <option value="ICT UNIT">ICT UNIT</option>
                    </select></p>
                    
                    <h5>TOTAL ITEMS</h5>
                </div>
                </div>
            </div> -->
        </div>
    </div>

</body>
</html>