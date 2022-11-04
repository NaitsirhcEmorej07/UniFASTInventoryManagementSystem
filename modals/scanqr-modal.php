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
    <div class="modal fade" id="scanqr-modal" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">

                <form method="POST" id="sbmt">

                    <div class="modal-header" style="background-color: #e3f2fd; font-size:20px; font-weight:bold;">
                        <p class="modal-title">SCAN QR</p>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body" id="modalbody">
                        <div class="container-fluid sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="27" height="26" fill="currentColor" class="bi bi-qr-code" viewBox="0 0 16 16" style="margin-top: -20px;">
                                <path d="M2 2h2v2H2V2Z" />
                                <path d="M6 0v6H0V0h6ZM5 1H1v4h4V1ZM4 12H2v2h2v-2Z" />
                                <path d="M6 10v6H0v-6h6Zm-5 1v4h4v-4H1Zm11-9h2v2h-2V2Z" />
                                <path d="M10 0v6h6V0h-6Zm5 1v4h-4V1h4ZM8 1V0h1v2H8v2H7V1h1Zm0 5V4h1v2H8ZM6 8V7h1V6h1v2h1V7h5v1h-4v1H7V8H6Zm0 0v1H2V8H1v1H0V7h3v1h3Zm10 1h-1V7h1v2Zm-1 0h-1v2h2v-1h-1V9Zm-4 0h2v1h-1v1h-1V9Zm2 3v-1h-1v1h-1v1H9v1h3v-2h1Zm0 0h3v1h-2v1h-1v-2Zm-4-1v1h1v-2H7v1h2Z" />
                                <path d="M7 12h1v3h4v1H7v-4Zm9 2v2h-3v-1h2v-1h1Z" />
                            </svg>
                            <textarea contenteditable="true" id="qrcontent" spellcheck="false" cols="20" rows="1" onkeypress="handle(event)" style="height:28px; font-size:17px; overflow:hidden; border-left: none; border-right: none; border-top: none; outline:none;  resize:none; " autofocus placeholder=""></textarea>
                            <div class="d-flex justify-content-center mt-1">
                                <div class="border border-dark p-2" id="qrcontentnew" style="font-size:15px; height:auto; width:443px;">
                                    <b>ITEM INFORMATION </b> <br>
                                    ITEM NAME: <br>
                                    DESCRIPTION: <br>
                                    SUPPLIER: <br>
                                    WARRANTY: <br>
                                    UNIT COST: <br>
                                    MR: <br>
                                    EU: <br>
                                    DATE RECEIVED: <br>
                                    SERIAL NO: <br>
                                    ICS NO: <br>
                                    IT NO: <br><br>

                                    <b>ITEM ASSIGNMENT HISTORY </b>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <script type="text/javascript">
        function handle(e) {
            if (e.keyCode === 13) {
                // var textarea = document.getElementById("qrcontent"); // contenteditable element
                // var textarea_value = textarea.innerHTML; // contenteditable element value
                // var bold_element = textarea.querySelectorAll('b')[0].innerHTML;

                var lines = $('#qrcontent').val().split('\n'); //gives all lines count
                var serialnumber = lines[0];
                var header = serialnumber.bold();

                $.ajax({
                    url: "request/qr-content-request.php",
                    method: "POST",
                    data: {
                        serialnumber: serialnumber
                    },
                    dataType: "json",
                    success: function(data) {





                        let php = Intl.NumberFormat('en-US');
                        console.log(data);

                        // let text = "ITEM INFORMATION";
                        // let result = text.bold();

                        var all = "ITEM INFORMATION".bold() +
                            "<br>" +
                            `<table>
                            <th style="width:140px">
                                <tr>
                                    <td>ITEM NAME:</td><td>` + data[0] + `</td>
                                </tr>
                                <tr>
                                    <td>DESCRIPTION:</td><td>` + data[1] + `</td>
                                </tr>
                                <tr>
                                    <td>SUPPLIER:</td><td>` + data[2] + `</td>
                                </tr>
                                <tr>
                                    <td>WARRANTY:</td><td>` + data[5] + ` YEAR/S</td>
                                </tr>
                                <tr>
                                    <td>UNIT COST:</td><td>₱ ` + php.format(data[3]) + `</td>
                                </tr>
                                <tr>
                                    <td>MR:</td><td>` + data[4] + `</td>
                                </tr>
                                <tr>
                                    <td>EU:</td><td>` + data[6] + `</td>
                                </tr>
                                <tr>
                                    <td>DATE RECEIVED:</td><td>` + data[8] + `</td>
                                </tr>
                                <tr>
                                    <td>SERIAL NO:</td><td>` + data[9] + `</td>
                                </tr>
                                <tr>
                                    <td>ICS NO:</td><td>` + data[10] + `</td>
                                </tr>
                                <tr>
                                    <td>IT NO:</td><td>` + data[11] + `</td>
                                </tr>
                            </th>
                        </table>` +
                            "<br>" + "ITEM ASSIGNMENT HISTORY".bold() + "<br>";

                        $.each(data.history, function(key, value) {
                            all += value.date_received + " - "
                            all += value.end_user + "<br>";
                        })



                        console.log(all);
                        $('#qrcontentnew').html(all);
                        $('#qrcontent').val("");
                        // document.getElementById("qrcontent").innerHTML = all;

                        // var messagetoSend = document.getElementById('qrcontent').value.replace(/,/g, "\n");
                        // console.log(messagetoSend);
                        // $('#qrcontent').val(messagetoSend);

                    }
                })

            }
        }
    </script>


</body>

</html>