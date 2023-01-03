<?php
//If there's no session, start a new session
if (!isset($_SESSION)) {
    session_start();
}

//If there's no session, always back to login
if (!isset($_SESSION['user_login'])) {
    echo header("Location: index.php");
}


//include database
include("connections/db-connect.php");

//include modals
include("modals/add-items-modal.php");
include("modals/update-items-modal.php");
include("modals/add-staff-modal.php");
include("modals/update-staff-modal.php");
include("modals/end-user-modal.php");
include("modals/update-enduser-modal.php");
include("modals/qr-path-modal.php");
include("modals/scanqr-modal.php");
include("modals/staff-items-modal.php");
include("modals/item-history-modal.php");
include("modals/unit-reports-select-modal.php");
include("modals/unit-reports-modal.php");
include("modals/mr-report-modal.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="css/footer-style.css" rel="stylesheet">
    <link href="css/select2.css" rel="stylesheet">
</head>

<body style="overflow-x: hidden;">

    <nav class="navbar navbar-expand-lg py-2 navbar-light" style="background-color: #e3f2fd;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#" style="font-size: 22px">
                <img src="img/unifast-web-logo.png" alt="" width="42" height="42">
                Inventory Management System</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                <div class="navbar-nav justify-content-end">

                    <a class="nav-link" href="chart.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16">
                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                            <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z" />
                        </svg>
                        Dashboard</a>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-list-check" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3.854 2.146a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 3.293l1.146-1.147a.5.5 0 0 1 .708 0zm0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 7.293l1.146-1.147a.5.5 0 0 1 .708 0zm0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z" />
                            </svg> List
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">

                            <li><a class="dropdown-item" href="inventory-items.php">Inventory Items</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="staff-page.php">UniFAST Staff</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#unit-reports-select-modal">UniFAST Units</a></li>
                        </ul>
                    </li>

                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#scanqr-modal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-qr-code" viewBox="0 0 16 16">
                            <path d="M2 2h2v2H2V2Z" />
                            <path d="M6 0v6H0V0h6ZM5 1H1v4h4V1ZM4 12H2v2h2v-2Z" />
                            <path d="M6 10v6H0v-6h6Zm-5 1v4h4v-4H1Zm11-9h2v2h-2V2Z" />
                            <path d="M10 0v6h6V0h-6Zm5 1v4h-4V1h4ZM8 1V0h1v2H8v2H7V1h1Zm0 5V4h1v2H8ZM6 8V7h1V6h1v2h1V7h5v1h-4v1H7V8H6Zm0 0v1H2V8H1v1H0V7h3v1h3Zm10 1h-1V7h1v2Zm-1 0h-1v2h2v-1h-1V9Zm-4 0h2v1h-1v1h-1V9Zm2 3v-1h-1v1h-1v1H9v1h3v-2h1Zm0 0h3v1h-2v1h-1v-2Zm-4-1v1h1v-2H7v1h2Z" />
                            <path d="M7 12h1v3h4v1H7v-4Zm9 2v2h-3v-1h2v-1h1Z" />
                        </svg>
                        Scan QR</a>

                    <a class="nav-link" href="request/logout.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                            <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                        </svg>
                        Sign Out</a>

                </div>
            </div>
        </div>
    </nav>



    <!-- <div class="footer">
        <?php
        // if (isset($_SESSION['user_login'])) {
        //     echo "User: " . ($_SESSION['session_full_name']);
        // } else {
        //     echo header("Location: index.php");
        // }
        ?>
    </div> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


    <script type="text/javascript">
        //FUNCTION FOR DATA TABLE
        $(document).ready(function() {
            $('#table1').DataTable({
                order: [
                    [1, 'asc']
                ],
            });

            $('#table_staff').DataTable();
        });

        //UNIFAST GENERATED SERIAL
        $(document).ready(function() {
            $(document).on('click', '.generateserial', function(event) {
                // var end_user_id = $('#btn_done_useredit').val();


                var current_date = new Date();

                const day = current_date.getDate();
                const month = current_date.getMonth() + 1;
                const year = current_date.getFullYear();
                const hours = current_date.getHours();
                const minutes = current_date.getMinutes();
                const seconds = current_date.getSeconds();
                const milliseconds = current_date.getMilliseconds();

                var milliseconds_length = String(milliseconds).length;

                var new_milliseconds;

                if (milliseconds_length == 3) {
                    new_milliseconds = milliseconds;
                } else if (milliseconds_length == 2) {
                    new_milliseconds = "0" + milliseconds;
                } else if (milliseconds_length == 1) {
                    new_milliseconds = "00" + milliseconds;
                }

                var unifastgenerated = "IMSGS";

                const date_time = year + "" + month + "" + day + "-" + hours + "" + minutes + "" + seconds + "" + new_milliseconds;

                // alert(unifastgenerated+""+date_time);

                $('#serial_number').val(unifastgenerated + "-" + date_time);

                // $.ajax({
                //     url: "request/select_fetch_auto_generate_serial_number.php",
                //     method: "POST",
                //     data: {
                //         end_user_id: end_user_id
                //     },
                //     dataType: "json",
                //     success: function(data) {
                //         console.log(serial + data.enduser_id);

                //     }
                // })
            });
        });



        //FUNCTION FOR FETCHING DATA TO INPUT FOR ITEM DESCRIPTION
        $(document).ready(function() {
            $(document).on('click', '.update', function(event) {
                event.preventDefault();
                var viewbtnval = $(this).attr("value");
                $.ajax({
                    url: "request/select_fetch_items.php",
                    method: "POST",
                    data: {
                        viewbtnvalx: viewbtnval
                    },
                    dataType: "json",
                    success: function(data) {
                        $('#update-items-modal').modal('show');
                        $('#itemid').val(data.id);
                        $('#item').val(data.item);
                        $('#item-desc').val(data.item_description);
                        $('#supplier').val(data.supplier);
                        $('#supplier_contact').val(data.supplier_contact);
                        $('#supplier_warranty').val(data.supplier_warranty);
                        $('#quantity').val(data.quantity);
                        $('#unit').val(data.unit);
                        $('#unit-cost').val(data.unit_cost);
                        $('#total_cost').val(data.total_cost);
                        $('#date_acquired').val(data.date_acquired);
                        $('#received_from').val(data.received_from);
                        $('#received_by option[value="' + data.received_by + '"]').prop('selected', true);

                    }
                })
            });
        });


        //FUNCTION FOR VIEWING OF END USERS 
        $(document).on('click', '.view', function() {
            viewEndUserTable($(this).attr("value"));

            $("#generateqr").val($(this).attr("value"));
            $('#end-user-modal').modal('show');
            var itm0 = $(this).closest('tr').find('#item0').text();
            // var itm1 = $(this).closest('tr').find('#item1').text();
            var itm2 = $(this).closest('tr').find('#item2').text();
            // var itm3 = $(this).closest('tr').find('#item3').text();
            // var itm4 = $(this).closest('tr').find('#item4').text();
            var itm5 = $(this).closest('tr').find('#item5').text();
            $("#btn_pdf2").attr("href", "request/select_fetch_table_items_pdf.php?f1x=" + itm0)
            // $("#desc1").html(itm1);
            // $("#desc3").html(itm3);
            // $("#desc4").html(itm4);
        });


        //FUNCTION FOR FETCHING DATA TO TABLE END USER
        function viewEndUserTable(f1) {
            $.ajax({
                url: "request/select_fetch_table_items.php",
                method: "POST",
                data: {
                    f1x: f1
                },
                dataType: "json",
                success: function(data) {



                    console.log(data);

                    // const newdate = new Date();
                    // newdate= data.date_acquired.setFullYear(data.date_acquired.getFullYear() + 1);
                    // console.log(newdate);

                    var warranty_value;

                    const warranty_end = new Date(data.date_acquired);
                    warranty_end.setFullYear(warranty_end.getFullYear() + parseInt(data.supplier_warranty));
                    console.log(warranty_end);

                    var current_date = new Date();
                    console.log(current_date);

                    if (warranty_end >= current_date) {
                        warranty_value = "UNTIL " + warranty_end.toDateString().toUpperCase().slice(4);
                        $("#warranty").css("color", "green");
                    } else {
                        warranty_value = "ENDED SINCE " + warranty_end.toDateString().toUpperCase().slice(4);
                        $("#warranty").css("color", "red");
                    }

                    var convert_date_acquired = new Date(data.date_acquired);
                    $('#testing').html(""); // CLEAR SCREAN BEFORE FETCHING TO AVOID DUPLICATION
                    $("#desc1").html(data.item);
                    $("#desc2").html(data.item_description);
                    $("#dateacquired").html(convert_date_acquired.toDateString().toUpperCase().slice(4));
                    $("#warranty").html(warranty_value);
                    $("#desc5").html(data.supplier);
                    $("#desc3").html(data.quantity);
                    $("#desc4").html(data.unit);




                    $.each(data.end_users, function(key, value) {

                        var prefix = "";
                        var fname = "";
                        var mname = "";
                        var lname = "";
                        var suffix = "";
                        var title = "";
                        var fullname = "";

                        prefix = value.prefix;
                        fname = value.first_name;
                        mname = value.middle_name;
                        lname = value.last_name;
                        suffix = value.suffix;
                        title = value.title;

                        if (lname == null) {
                            fullname = "";
                        } else {

                            if (prefix == "N/A" || prefix == "") {
                                prefix = "";
                            } else {
                                prefix = prefix + " ";
                            }

                            if (mname == "N/A" || mname == "") {
                                mname = "";
                            } else {
                                mname = " " + mname;
                            }

                            if (suffix == "N/A" || suffix == "") {
                                suffix = "";
                            } else {
                                suffix = ", " + suffix;
                            }

                            if (title == "N/A" || title == "") {
                                title = "";
                            } else {
                                title = ", " + title;
                            }
                            fullname = prefix + lname + ", " + fname + " " + mname + suffix + title;
                        }
                        

                        var convert_date_received = new Date(value.date_received);
                        convert_date_received = convert_date_received.toDateString().toUpperCase().slice(4);
                        $('#testing').append(`<tr>
                                                <td>` + (parseInt(1) + parseInt(key)) + `</td>
                                                <td>${value.serial_number ? value.serial_number : ""}</td>
                                                <td style='text-align:center;'>${value.inventory_item_number ? value.inventory_item_number : ""}</td>
                                                <td>${value.ics_number ? value.ics_number : ""}</td>
                                                <td>${value.status ? value.status : ""}</td>
                                                <td>${data.received_by ? data.received_by : ""}</td>
                                                <td>${fullname ? fullname : ""}</td>
                                                <td>${convert_date_received == null || convert_date_received == '0000-00-00' || convert_date_received == '' || convert_date_received == 'JAN 01 1970' ? "" : convert_date_received}</td>

                                                <td><button type="button" id="buttonf" value="${value.enduser_id}" class="btn btn-primary btn-sm updateuser" href="#">Edit</button>
                                                    <button type="button" id="buttonhistory" value="${value.serial_number}" class="btn btn-warning btn-sm itemhistory" href="#" data-bs-toggle="modal" data-bs-target="#item-history-modal">History</button>
                                                </td>

                                            </tr>`);
                        $('#modal_id').val(f1);
                    })

                }
            });
        }


        //FUNCTION FOR FETCHING DATA TO INPUT IN END USER
        $(document).on('click', '.updateuser', function(event) {
            event.preventDefault();
            var viewupdatebtn = $(this).attr("value");
            $.ajax({
                url: "request/select_fetch_enduser.php",
                method: "POST",
                data: {
                    viewupdatebtnx: viewupdatebtn
                },
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    $('#update-enduser-modal').modal('show');
                    $('#btn_done_useredit').val(data.enduser_id);
                    $('#enduser_id').val(data.enduser_id);
                    $('#end_user').val(data.end_user);
                    $('#select2-end_user-container').html(data.end_user);
                    $('#date_received').val(data.date_received);
                    $('#serial_number').val(data.serial_number);
                    $('#inventory_item_number').val(data.inventory_item_number);
                    $('#ics_number').val(data.ics_number);
                    $('#status option[value="' + data.status + '"]').prop('selected', true);
                }
            })
        });


        //FUNCTION FOR UPDATING END USER
        $(document).ready(function() {
            $(document).on('click', '.updatesubmit', function() {
                document.getElementById('wrapper').style.display = 'none';
                $.ajax({
                    url: "request/update_enduser.php",
                    method: "POST",
                    data: $('#update_user_form').serialize(),
                    success: function(x) {

                        console.log(x);
                        // console.log($('#update_user_form').serialize())
                        $('#update-enduser-modal').modal('hide');
                        viewEndUserTable($('#modal_id').val());
                    }
                })
            });
        });

        //FUNCTION FOR FETCHING DATA TO STAFF
        $(document).ready(function() {
            $(document).on('click', '.viewstaff', function() {
                var staffupdatebtn = $(this).attr("value");
                $.ajax({
                    url: "request/select_fetch_staff.php",
                    method: "POST",
                    data: {
                        staffupdatebtn: staffupdatebtn
                    },
                    dataType: "json",
                    success: function(data) {

                        console.log(data);
                        $('#update-staff-modal').modal('show');

                        $('#enduserid').val(staffupdatebtn);
                        $('#id_no').val(data.id_no);
                        $('#staff_first_name').val(data.first_name);
                        $('#staff_middle_name').val(data.middle_name);
                        $('#staff_last_name').val(data.last_name);
                        $('#staff_prefix_name').val(data.prefix);
                        $('#staff_suffix_name option[value="' + data.suffix + '"]').prop('selected', true);
                        $('#staff_title_name').val(data.title);
                        $('#full_name').val(data.full_name);
                        // $('#designation').val(data.designation);
                        $('#designation option[value="' + data.designation + '"]').prop('selected', true);
                        $('#unit option[value="' + data.unit + '"]').prop('selected', true);
                        $('#statusstaff option[value="' + data.status + '"]').prop('selected', true);
                    }
                })
            });
        });


        //FUNCTION FOR GENERATING QRCODE
        $(document).ready(function() {
            $(document).on('click', '.generateqrcode', function() {
                var inventoryid = $('#generateqr').attr("value");
                $.ajax({
                    url: "request/qr_request.php",
                    method: "POST",
                    data: {
                        inventoryid: inventoryid
                    },
                    // dataType: "json",
                    success: function(data) {
                        $('#qr-path-modal').modal('show');
                    }
                })
            });
        });


        //FUNCTION FOR FETCHING TABLE FOR STAFF ITEMS DETAILS
        $(document).ready(function() {
            $(document).on('click', '.viewstaffitems', function(event) {

                var id = $(this).attr("value");
                var itm1 = $(this).closest('tr').find('#item3').text();
                var itm2 = $(this).closest('tr').find('#item4').text();
                var itm3 = $(this).closest('tr').find('#item5').text();
                $("#btn_pdf").attr("href", "request/select_fetch_table_enduser_items_pdf.php?id=" + id);
                $("#enduser").html(itm1);
                $("#endusernameid").html(itm1);
                $("#position").html(itm2);
                $("#unit1").html(itm3);


                $.ajax({
                    url: "request/select_fetch_table_enduser_items.php",
                    method: "POST",
                    data: {
                        id
                    },
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        $('#tablestaffitemsbody').html(""); // CLEAR SCREAN BEFORE FETCHING TO AVOID DUPLICATION
                        $('#stafftotalcost').html("0"); // CLEAR SCREAN BEFORE FETCHING TO AVOID DUPLICATION



                        var total = 0;
                        let php1 = Intl.NumberFormat('en-US');
                        $.each(data, function(key, value) {
                            var warranty_value;
                            const warranty_end = new Date(value.date_acquired);
                            warranty_end.setFullYear(warranty_end.getFullYear() + parseInt(value.supplier_warranty));

                            var current_date = new Date();

                            if (warranty_end >= current_date) {
                                var convert_date = new Date(value.date_received);
                                var rowCount = $('#tablestaffitems >tbody >tr').length;
                                $('#tablestaffitemsbody').append("<tr>\
                                                <td style='text-align:left'>" + (parseInt(key) + 1) + "</td>\
                                                <td style='text-align:left'>" + value.item + "</td>\
                                                <td style='text-align:left'>" + value.item_description + "</td>\
                                                <td>" + value.received_by + "</td>\
                                                <td>" + convert_date.toDateString().toUpperCase().slice(4) + "</td>\
                                                <td style='text-align:center; color:green;'>" + "UNTIL " + warranty_end.toDateString().toUpperCase().slice(4) + "</td>\
                                                <td style='text-align:center'>" + value.serial_number + "</td>\
                                                <td style='text-align:center'>₱ " + php1.format(value.unit_cost) + " </td>\
                                            </tr>");


                                //CODES FOR SUM OF ITEMS IN STAFF
                                total += parseInt(value.unit_cost);
                                document.getElementById("stafftotalcost").innerHTML = php1.format(total);
                                document.getElementById("stafftotalitems").innerHTML = (parseInt(key) + 1);

                            } else {
                                var convert_date = new Date(value.date_received);
                                var rowCount = $('#tablestaffitems >tbody >tr').length;
                                $('#tablestaffitemsbody').append("<tr>\
                                                <td style='text-align:left'>" + (parseInt(key) + 1) + "</td>\
                                                <td style='text-align:left'>" + value.item + "</td>\
                                                <td style='text-align:left'>" + value.item_description + "</td>\
                                                <td>" + value.received_by + "</td>\
                                                <td>" + convert_date.toDateString().toUpperCase().slice(4) + "</td>\
                                                <td style='text-align:center; color:red;'>" + "ENDED " + warranty_end.toDateString().toUpperCase().slice(4) + "</td>\
                                                <td style='text-align:center'>" + value.serial_number + "</td>\
                                                <td style='text-align:center'>₱ " + php1.format(value.unit_cost) + " </td>\
                                            </tr>");


                                //CODES FOR SUM OF ITEMS IN STAFF
                                total += parseInt(value.unit_cost);
                                document.getElementById("stafftotalcost").innerHTML = php1.format(total);
                                document.getElementById("stafftotalitems").innerHTML = (parseInt(key) + 1);
                            }


                        })
                    }
                });
            });
        });


        //FUNCTION FETCHING TABLE FOR HISTORY OF ITEMS
        $(document).ready(function() {
            $(document).on('click', '.itemhistory', function(event) {
                var sntobtn = $(this).attr("value");
                $("#serialnumber").val(sntobtn);


                $.ajax({
                    url: "request/select_fetch_table_history.php",
                    method: "POST",
                    data: {
                        sntobtn: sntobtn
                    },
                    dataType: "json",
                    success: function(data) {

                        console.log(data);
                        $('#historybody').html("");

                        $.each(data, function(key, value) {
                            var prefix = "";
                            var fname = "";
                            var mname = "";
                            var lname = "";
                            var suffix = "";
                            var title = "";
                            var fullname = "";

                            prefix = value.prefix;
                            fname = value.first_name;
                            mname = value.middle_name;
                            lname = value.last_name;
                            suffix = value.suffix;
                            title = value.title;

                            if (prefix == "N/A" || prefix == "") {
                                prefix = "";
                            } else {
                                prefix = prefix + " ";
                            }

                            if (mname == "N/A" || mname == "") {
                                mname = "";
                            } else {
                                mname = " " + mname;
                            }

                            if (suffix == "N/A" || suffix == "") {
                                suffix = "";
                            } else {
                                suffix = ", " + suffix;
                            }

                            if (title == "N/A" || title == "") {
                                title = "";
                            } else {
                                title = ", " + title;
                            }

                            fullname = prefix + lname + ", " + fname + " " + mname + suffix + title;

                            var convert_date_acquired = new Date(value.date_received);
                            $('#historybody').append("<tr>\
                                                <td>" + fullname + "</td>\
                                                <td>" + convert_date_acquired.toDateString().toUpperCase().slice(4) + "</td>\
                                                <td>" + value.status + "</td>\
                                            </tr>");
                        })
                    }
                })
            });
        });


        //FUNCTION ADFIN UNIT BUTTONS ---------------------------------------------------------------------------------
        $(document).ready(function() {
            $(document).on('click', '.adfinunit', function(event) {
                var unit = $(this).attr("value");
                $("#hiddenunit").val(unit);
                $("#showunit").html(unit);

                $('#unit-reports-select-modal').modal('hide');
                $('#unit-reports-modal').modal('show');

                $("#btn_pdf3").attr("href", "request/select_fetch_table_units_pdf.php?unit=" + unit)

                $.ajax({
                    url: "request/select_fetch_table_units.php",
                    method: "POST",
                    data: {
                        unit: unit
                    },
                    dataType: "json",
                    success: function(data) {
                        $('#table-body-unit-reports').html("");
                        console.log(data);
                        var total = 0;
                        let php1 = Intl.NumberFormat('en-US');
                        $.each(data, function(key, value) {
                            var convert_date = new Date(value.date_received);
                            $('#table-body-unit-reports').append("<tr>\
                                                <td>" + (parseInt(key) + 1) + "</td>\
                                                <td>" + value.designation + "</td>\
                                                <td>" + value.end_user + "</td>\
                                                <td>" + convert_date.toDateString().toUpperCase().slice(4) + "</td>\
                                                <td>" + value.item + "</td>\
                                                <td>" + value.item_description + "</td>\
                                                <td>" + value.serial_number + "</td>\
                                                <td>₱ " + php1.format(value.unit_cost) + "</td>\
                                            </tr>");
                            $('#totalitemsunit').html(key + 1);
                            total += parseInt(value.unit_cost);
                            document.getElementById("totalcostunit").innerHTML = php1.format(total);
                        })
                    }
                })
            });
        });

        //FUNCTION OED UNIT BUTTONS
        $(document).ready(function() {
            $(document).on('click', '.oedunit', function(event) {
                var unit = $(this).attr("value");
                $("#hiddenunit").val(unit);
                $("#showunit").html(unit);

                $('#unit-reports-select-modal').modal('hide');
                $('#unit-reports-modal').modal('show');

                $("#btn_pdf3").attr("href", "request/select_fetch_table_units_pdf.php?unit=" + unit)

                $.ajax({
                    url: "request/select_fetch_table_units.php",
                    method: "POST",
                    data: {
                        unit: unit
                    },
                    dataType: "json",
                    success: function(data) {
                        $('#table-body-unit-reports').html("");
                        console.log(data);
                        var total = 0;
                        let php1 = Intl.NumberFormat('en-US');
                        $.each(data, function(key, value) {
                            var convert_date = new Date(value.date_received);
                            $('#table-body-unit-reports').append("<tr>\
                                                <td>" + (parseInt(key) + 1) + "</td>\
                                                <td>" + value.designation + "</td>\
                                                <td>" + value.end_user + "</td>\
                                                <td>" + convert_date.toDateString().toUpperCase().slice(4) + "</td>\
                                                <td>" + value.item + "</td>\
                                                <td>" + value.item_description + "</td>\
                                                <td>" + value.serial_number + "</td>\
                                                <td>₱ " + php1.format(value.unit_cost) + "</td>\
                                            </tr>");
                            $('#totalitemsunit').html(key + 1);
                            total += parseInt(value.unit_cost);
                            document.getElementById("totalcostunit").innerHTML = php1.format(total);
                        })
                    }
                })
            });
        });

        //FUNCTION BILLING UNIT BUTTONS
        $(document).ready(function() {
            $(document).on('click', '.billingunit', function(event) {
                var unit = $(this).attr("value");
                $("#hiddenunit").val(unit);
                $("#showunit").html(unit);

                $('#unit-reports-select-modal').modal('hide');
                $('#unit-reports-modal').modal('show');

                $("#btn_pdf3").attr("href", "request/select_fetch_table_units_pdf.php?unit=" + unit)

                $.ajax({
                    url: "request/select_fetch_table_units.php",
                    method: "POST",
                    data: {
                        unit: unit
                    },
                    dataType: "json",
                    success: function(data) {
                        $('#table-body-unit-reports').html("");
                        console.log(data);
                        var total = 0;
                        let php1 = Intl.NumberFormat('en-US');
                        $.each(data, function(key, value) {
                            var convert_date = new Date(value.date_received);
                            $('#table-body-unit-reports').append("<tr>\
                                                <td>" + (parseInt(key) + 1) + "</td>\
                                                <td>" + value.designation + "</td>\
                                                <td>" + value.end_user + "</td>\
                                                <td>" + convert_date.toDateString().toUpperCase().slice(4) + "</td>\
                                                <td>" + value.item + "</td>\
                                                <td>" + value.item_description + "</td>\
                                                <td>" + value.serial_number + "</td>\
                                                <td>₱ " + php1.format(value.unit_cost) + "</td>\
                                            </tr>");
                            $('#totalitemsunit').html(key + 1);
                            total += parseInt(value.unit_cost);
                            document.getElementById("totalcostunit").innerHTML = php1.format(total);
                        })
                    }
                })
            });
        });

        //FUNCTION ADVOC UNIT BUTTONS
        $(document).ready(function() {
            $(document).on('click', '.advocunit', function(event) {
                var unit = $(this).attr("value");
                $("#hiddenunit").val(unit);
                $("#showunit").html(unit);

                $('#unit-reports-select-modal').modal('hide');
                $('#unit-reports-modal').modal('show');

                $("#btn_pdf3").attr("href", "request/select_fetch_table_units_pdf.php?unit=" + unit)

                $.ajax({
                    url: "request/select_fetch_table_units.php",
                    method: "POST",
                    data: {
                        unit: unit
                    },
                    dataType: "json",
                    success: function(data) {
                        $('#table-body-unit-reports').html("");
                        console.log(data);
                        var total = 0;
                        let php1 = Intl.NumberFormat('en-US');
                        $.each(data, function(key, value) {
                            var convert_date = new Date(value.date_received);
                            $('#table-body-unit-reports').append("<tr>\
                                                <td>" + (parseInt(key) + 1) + "</td>\
                                                <td>" + value.designation + "</td>\
                                                <td>" + value.end_user + "</td>\
                                                <td>" + convert_date.toDateString().toUpperCase().slice(4) + "</td>\
                                                <td>" + value.item + "</td>\
                                                <td>" + value.item_description + "</td>\
                                                <td>" + value.serial_number + "</td>\
                                                <td>₱ " + php1.format(value.unit_cost) + "</td>\
                                            </tr>");
                            $('#totalitemsunit').html(key + 1);
                            total += parseInt(value.unit_cost);
                            document.getElementById("totalcostunit").innerHTML = php1.format(total);
                        })
                    }
                })
            });
        });

        //FUNCTION ICT UNIT BUTTONS
        $(document).ready(function() {
            $(document).on('click', '.ictunit', function(event) {
                var unit = $(this).attr("value");
                $("#hiddenunit").val(unit);
                $("#showunit").html(unit);

                $('#unit-reports-select-modal').modal('hide');
                $('#unit-reports-modal').modal('show');

                $("#btn_pdf3").attr("href", "request/select_fetch_table_units_pdf.php?unit=" + unit)

                $.ajax({
                    url: "request/select_fetch_table_units.php",
                    method: "POST",
                    data: {
                        unit: unit
                    },
                    dataType: "json",
                    success: function(data) {
                        $('#table-body-unit-reports').html("");
                        console.log(data);
                        var total = 0;
                        let php1 = Intl.NumberFormat('en-US');

                        $.each(data, function(key, value) {
                            var convert_date = new Date(value.date_received);
                            $('#table-body-unit-reports').append("<tr>\
                                                <td>" + (parseInt(key) + 1) + "</td>\
                                                <td>" + value.designation + "</td>\
                                                <td>" + value.end_user + "</td>\
                                                <td>" + convert_date.toDateString().toUpperCase().slice(4) + "</td>\
                                                <td>" + value.item + "</td>\
                                                <td>" + value.item_description + "</td>\
                                                <td>" + value.serial_number + "</td>\
                                                <td>₱ " + php1.format(value.unit_cost) + "</td>\
                                            </tr>");
                            $('#totalitemsunit').html(key + 1);
                            total += parseInt(value.unit_cost);
                            document.getElementById("totalcostunit").innerHTML = php1.format(total);
                        })
                    }
                })
            });
        });

        //FUNCTION PMED BUTTONS
        $(document).ready(function() {
            $(document).on('click', '.pmedunit', function(event) {
                var unit = $(this).attr("value");
                $("#hiddenunit").val(unit);
                $("#showunit").html(unit);

                $('#unit-reports-select-modal').modal('hide');
                $('#unit-reports-modal').modal('show');

                $("#btn_pdf3").attr("href", "request/select_fetch_table_units_pdf.php?unit=" + unit)

                $.ajax({
                    url: "request/select_fetch_table_units.php",
                    method: "POST",
                    data: {
                        unit: unit
                    },
                    dataType: "json",
                    success: function(data) {
                        $('#table-body-unit-reports').html("");
                        console.log(data);
                        var total = 0;
                        let php1 = Intl.NumberFormat('en-US');
                        $.each(data, function(key, value) {
                            var convert_date = new Date(value.date_received);
                            $('#table-body-unit-reports').append("<tr>\
                                                <td>" + (parseInt(key) + 1) + "</td>\
                                                <td>" + value.designation + "</td>\
                                                <td>" + value.end_user + "</td>\
                                                <td>" + convert_date.toDateString().toUpperCase().slice(4) + "</td>\
                                                <td>" + value.item + "</td>\
                                                <td>" + value.item_description + "</td>\
                                                <td>" + value.serial_number + "</td>\
                                                <td>₱ " + php1.format(value.unit_cost) + "</td>\
                                            </tr>");
                            $('#totalitemsunit').html(key + 1);
                            total += parseInt(value.unit_cost);
                            document.getElementById("totalcostunit").innerHTML = php1.format(total);
                        })
                    }
                })
            });
        });



        //SAMPLE TIMER SCRIPT
        function myMessage() {
            a = "THIS IS FUNCTION FOR TIMER MESSAGE IN 3 SECONDS";
            console.log(a);
        }
        setTimeout(myMessage, 3000);


        // JQUERY FOR SELECTING PLANTILLA POSITION IN MR REPORT
        $(".selectplantilla").change(function() {
            var plantilla = $('#selectplantilla').find(":selected").val();
            // alert(plantilla);

            $("#btn_pdf4").attr("href", "request/select_fetch_table_materials_requisition_pdf.php?plantilla=" + plantilla)
            $.ajax({
                url: "request/select_fetch_table_materials_requisition.php",
                method: "GET",
                data: {
                    plantilla: plantilla
                },
                dataType: "json",
                success: function(data) {
                    let php1 = Intl.NumberFormat('en-US');
                    $('#table-body-mr-reports').html("");
                    $('#totalitemsmr').html("");
                    $('#totalcostmrd').html("");
                    $('#plantillaposition').html("");
                    $('#plantillaunit').html("");
                    $('#pesosign').html("");

                    console.log(data);
                    var total = 0;
                    var totalquantity = 0;

                    document.getElementById("plantillaposition").innerHTML = data.designation;
                    document.getElementById("plantillaunit").innerHTML = data.unit;
                    document.getElementById("pesosign").innerHTML = "₱ ";

                    $.each(data.plantillaitem, function(key, value) {
                        var warranty_value;

                        const warranty_end = new Date(value.date_acquired);
                        warranty_end.setFullYear(warranty_end.getFullYear() + parseInt(value.supplier_warranty));

                        var current_date = new Date();


                        if (warranty_end >= current_date) {
                            var convert_date = new Date(value.date_acquired);
                            $('#table-body-mr-reports').append("<tr>\
                                                <td style='text-align:left'>" + (parseInt(key) + 1) + "</td>\
                                                <td style='text-align:left'>" + value.item + "</td>\
                                                <td style='text-align:left'>" + value.item_description + "</td>\
                                                <td style='text-align:left'>" + value.quantity + " " + value.unit + "</td>\
                                                <td style='text-align:left'>₱ " + php1.format(value.unit_cost) + "</td>\
                                                <td style='text-align:left'>₱ " + php1.format(value.total_cost) + "</td>\
                                                <td style='text-align:center'>" + convert_date.toDateString().toUpperCase().slice(4) + "</td>\
                                                <td style='text-align:center; color:green;'>" + "UNTIL " + warranty_end.toDateString().toUpperCase().slice(4) + "</td>\
                                            </tr>");
                            total += parseInt(value.total_cost);
                            document.getElementById("totalcostmrd").innerHTML = php1.format(total);

                            totalquantity += parseInt(value.quantity);
                            $('#totalitemsmr').html(totalquantity);
                        } else {
                            var convert_date = new Date(value.date_acquired);
                            $('#table-body-mr-reports').append("<tr>\
                                                <td style='text-align:left'>" + (parseInt(key) + 1) + "</td>\
                                                <td style='text-align:left'>" + value.item + "</td>\
                                                <td style='text-align:left'>" + value.item_description + "</td>\
                                                <td style='text-align:left'>" + value.quantity + " " + value.unit + "</td>\
                                                <td style='text-align:left'>₱ " + php1.format(value.unit_cost) + "</td>\
                                                <td style='text-align:left'>₱ " + php1.format(value.total_cost) + "</td>\
                                                <td style='text-align:center'>" + convert_date.toDateString().toUpperCase().slice(4) + "</td>\
                                                <td style='text-align:center; color:red;'>" + "ENDED " + warranty_end.toDateString().toUpperCase().slice(4) + " </td>\
                                            </tr>");
                            total += parseInt(value.total_cost);
                            document.getElementById("totalcostmrd").innerHTML = php1.format(total);

                            totalquantity += parseInt(value.quantity);
                            $('#totalitemsmr').html(totalquantity);

                        }


                    })
                }
            })
        });


        $(".selectitemstatus").change(function() {

            var status = $('#status').find(":selected").val();
            if (status == "RETURNED TO CHED") {
                document.getElementById('wrapper').style.display = 'block';
                // $('#end_user').text("");
                // $('.select2-selection').val("");
                // $('.select2-selection--single').toArray[0];
                $('#end_user').val("");

            } else {
                document.getElementById('wrapper').style.display = 'none';
            }
        });

        $(".closealert").click(function() {
            document.getElementById('wrapper').style.display = 'none';
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>



    <!-- SCRIPT FOR SELECT 2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $('#end_user').select2({
                dropdownParent: $('#update-enduser-modal')

            });
        });
    </script>

</body>

</html>