<?php
include("navbar.php");
include("connections/db-connect.php");

//---------------------------------------------------------------------------- PHP QUERY FOR DOUGHNUT CHART
//PHP QUERY FOR COS
$sqlcos = "
SELECT COUNT(employment_type)
FROM end_user_list_tbl
WHERE employment_type = 'COS' 
";
$result = mysqli_query($conn, $sqlcos);
while ($row = mysqli_fetch_array($result)) {
    $rowcos = $row["COUNT(employment_type)"];
}

//PHP QUERY FOR PLANTILLA
$sqlplantilla = "
SELECT COUNT(employment_type)
FROM end_user_list_tbl
WHERE employment_type = 'PLANTILLA' 
";
$result = mysqli_query($conn, $sqlplantilla);
while ($row = mysqli_fetch_array($result)) {
    $rowplantilla = $row["COUNT(employment_type)"];
}




//---------------------------------------------------------------------------- PHP QUERY FOR PIE CHART
//PHP QUERY FOR DAMAGED
$sqldamaged = "
SELECT COUNT(status)
FROM end_user_tbl
WHERE status = 'damaged' 
";
$result = mysqli_query($conn, $sqldamaged);
while ($row = mysqli_fetch_array($result)) {
    $rowdamaged = $row["COUNT(status)"];
}

//PHP QUERY FOR REPAIRED
$sqlrepaired = "
SELECT COUNT(status)
FROM end_user_tbl
WHERE status = 'repaired' 
";
$result = mysqli_query($conn, $sqlrepaired);
while ($row = mysqli_fetch_array($result)) {
    $rowrepaired = $row["COUNT(status)"];
}

//PHP QUERY FOR GOOD CONDITION
$sqlgoodcondition = "
SELECT COUNT(status)
FROM end_user_tbl
WHERE status = 'GOOD CONDITION' 
";
$result = mysqli_query($conn, $sqlgoodcondition);
while ($row = mysqli_fetch_array($result)) {
    $rowgoodcondition = $row["COUNT(status)"];
}

//PHP QUERY FOR RETURNED TO CHED
$sqlrtc = "
SELECT COUNT(status)
FROM end_user_tbl
WHERE status = 'RETURNED TO CHED' 
";
$result = mysqli_query($conn, $sqlrtc);
while ($row = mysqli_fetch_array($result)) {
    $rowrtc = $row["COUNT(status)"];
}

//PHP QUERY FOR MISSING
$sqlmissing = "
SELECT COUNT(status)
FROM end_user_tbl
WHERE status = 'MISSING'
";
$result = mysqli_query($conn, $sqlmissing);
while ($row = mysqli_fetch_array($result)) {
    $rowmissing = $row["COUNT(status)"];
}

//PHP QUERY FOR MISSING-PAID
$sqlmissingpaid = "
SELECT COUNT(status)
FROM end_user_tbl
WHERE status ='MISSING-PAID'
";
$result = mysqli_query($conn, $sqlmissingpaid);
while ($row = mysqli_fetch_array($result)) {
    $rowmissingpaid = $row["COUNT(status)"];
}


//PHP QUERY FOR MISSING-REPLACED
$sqlmissingreplaced = "
SELECT COUNT(status)
FROM end_user_tbl
WHERE status ='MISSING-REPLACED'
";
$result = mysqli_query($conn, $sqlmissingreplaced);
while ($row = mysqli_fetch_array($result)) {
    $rowmissingreplaced = $row["COUNT(status)"];
}



//---------------------------------------------------------------------------- PHP QUERY FOR BAR CHART
//PHP QUERY FOR OED UNIT
$sqloed = "
SELECT COUNT(unit)
FROM end_user_tbl
WHERE unit = 'OED UNIT' 
";
$result = mysqli_query($conn, $sqloed);
while ($row = mysqli_fetch_array($result)) {
    $rowoed = $row["COUNT(unit)"];
}

//PHP QUERY FOR ADFIN UNIT
$sqladfin = "
SELECT COUNT(unit)
FROM end_user_tbl
WHERE unit = 'ADFIN UNIT' 
";
$result = mysqli_query($conn, $sqladfin);
while ($row = mysqli_fetch_array($result)) {
    $rowadfin = $row["COUNT(unit)"];
}

//PHP QUERY FOR ADVOC UNIT
$sqladvoc = "
SELECT COUNT(unit)
FROM end_user_tbl
WHERE unit = 'ADVOC UNIT' 
";
$result = mysqli_query($conn, $sqladvoc);
while ($row = mysqli_fetch_array($result)) {
    $rowadvoc = $row["COUNT(unit)"];
}

//PHP QUERY FOR BILLING UNIT
$sqlbilling = "
SELECT COUNT(unit)
FROM end_user_tbl
WHERE unit = 'BILLING UNIT' 
";
$result = mysqli_query($conn, $sqlbilling);
while ($row = mysqli_fetch_array($result)) {
    $rowbilling = $row["COUNT(unit)"];
}

//PHP QUERY FOR PMED UNIT
$sqlpmed = "
SELECT COUNT(unit)
FROM end_user_tbl
WHERE unit = 'PMED UNIT' 
";
$result = mysqli_query($conn, $sqlpmed);
while ($row = mysqli_fetch_array($result)) {
    $rowpmed = $row["COUNT(unit)"];
}

//PHP QUERY FOR ICT UNIT
$sqlict = "
SELECT COUNT(unit)
FROM end_user_tbl
WHERE unit = 'ICT UNIT' 
";
$result = mysqli_query($conn, $sqlict);
while ($row = mysqli_fetch_array($result)) {
    $rowict = $row["COUNT(unit)"];
}



$dataPoints = array(
    array("label" => "DAMAGED", "y" => $rowdamaged),
    array("label" => "REPAIRED", "y" => $rowrepaired),
    array("label" => "GOOD CONDITION", "y" => $rowgoodcondition),
    array("label" => "RETURNED TO CHED", "y" => $rowrtc),
    array("label" => "MISSING", "y" => $rowmissing), 
    array("label" => "MISSING-PAID       ", "y" => $rowmissingpaid),
    array("label" => "MISSING-REPLACED", "y" => $rowmissingreplaced)
    
)

?>
<!DOCTYPE HTML>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script>
        window.onload = function() {


            //DOUGHNUT CHART SCRIPT
            var chart = new CanvasJS.Chart("chartContainerDNT", {
                animationEnabled: true,
                title: {
                    text: "UniFAST Staff",
                    horizontalAlign: "center"
                },
                subtitles: [{
                    text: "As of <?php echo (date("m/d/Y")) ?>"
                }],
                data: [{
                    type: "doughnut",
                    startAngle: 60,
                    //innerRadius: 60,
                    indexLabelFontSize: 17,
                    indexLabel: "{label} - #percent%",
                    toolTipContent: "<b>{label}:</b> {y} (#percent%)",
                    dataPoints: [{
                            y: <?php echo ($rowplantilla); ?>,
                            label: "PLANTILLA"
                        },
                        {
                            y: <?php echo ($rowcos); ?>,
                            label: "C.O.S"
                        }
                    ]
                }]
            });
            chart.render();


            //PIE CHART SCRIPT
            var chart = new CanvasJS.Chart("chartContainerPie", {
                animationEnabled: true,
                title: {
                    text: "Item Status"
                },
                subtitles: [{
                    text: "As of <?php echo (date("m/d/Y")) ?>"
                }],
                data: [{
                    type: "pie",
                    yValueFormatString: "#,##0.\" items\"",
                    indexLabel: "{label} ({y})",
                    indexLabelMaxWidth: 140,
                    indexLabelFontSize: 16,
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();


            var chart = new CanvasJS.Chart("chartContainerBAR", {
                animationEnabled: true,
                theme: "light1", // "light1", "light2", "dark1", "dark2"
                title: {
                    text: "Distribution of Items per Unit"
                },
                axisY: {
                    title: "Number of Items"
                },
                data: [{
                    type: "column",
                    // showInLegend: true,
                    // // legendMarkerColor: "grey",
                    // // // legendText: "MMbbl = one million barrels",
                    dataPoints: [{
                            y: <?php echo($rowoed) ?>,
                            label: "OED UNIT"
                        },
                        {
                            y: <?php echo($rowadfin) ?>,
                            label: "ADFIN UNIT"
                        },
                        {
                            y: <?php echo($rowadvoc) ?>,
                            label: "ADVOC UNIT"
                        },
                        {
                            y: <?php echo($rowbilling) ?>,
                            label: "BILLING UNIT"
                        },
                        {
                            y: <?php echo($rowpmed) ?>,
                            label: "PMED UNIT"
                        },
                        {
                            y: <?php echo($rowict) ?>,
                            label: "ICT UNIT"
                        }
                    ]
                }]
            });
            chart.render();
        }
    </script>
</head>

















<body>

    <div style="position:absolute; top: 524px; width: 100%; height: 10px; background-color:white;z-index:1"></div>
    <div style="position:absolute; top: 1022px; width: 100%; height: 10px; background-color:white;z-index:1 "></div>
    <div class="row d-flex justify-content-center">
        <div class="col-11 mt-3 mb-5">
            <div id="chartContainerBAR" style="height: 450px; width: 100%; z-index:-1"></div>
        </div>


        <!-- <div class="col-2 border">
        P500,000
        </div>
        <div class="col-2 border">
        P500,000
        </div>
        <div class="col-2 border">
        P500,000
        </div>
        <div class="col-2 border">
        P500,000
        </div>
        <div class="col-2 border">
        P500,000
        </div>
        <div class="col-2 border">
        P500,000
        </div> -->




        <div class="col-6 mb-1 ">
            <div id="chartContainerPie" style="height: 450px; width: 100%;z-index:-1"></div>
        </div>
        <div class="col-6 mb-1 ">
            <div id="chartContainerDNT" style="height: 450px; width: 100%;z-index:-1"></div>
        </div>

    </div>





    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>

</html>