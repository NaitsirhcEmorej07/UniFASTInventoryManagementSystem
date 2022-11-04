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
                        <div style="background-image: url('img/scan-qr-tools.png'); height: 610px; background-repeat: no-repeat; background-size: cover;">
                            <div class="container-fluid sm">
                                <textarea contenteditable="true" id="qrcontent" spellcheck="false" cols="34" rows="17" onkeypress="handle(event)" style="margin-left: 115px; margin-top: 71px;font-size:14px; border: none; outline: none;"></textarea>
                                <div id="qrcontent">

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

                        let text = "ITEM INFORMATION";
                        let result = text.bold();

                        var all = "ITEM INFORMATION" + "\n" + "ITEM NAME: " +
                            data[0] + "\n" + "DESCRIPTION: " +
                            data[1] + "\n" + "SUPPLIER: " +
                            data[2] + "\n" + "WARRANTY: " +
                            data[5] + " YEAR/S" + "\n" + "UNIT COST: " +
                            php.format(data[3]) + " Php" + "\n" + "MR: " +
                            data[4] + "\n" + "EU: " +
                            data[6] + "\n" + "DATE RECEIVED: " +
                            data[8] + "\n" + "SERIAL NO: " +
                            data[9] + "\n" + "ICS NO: " +
                            data[10] + "\n" + "IT NO: " +
                            data[11] + "\n \n" + "ITEM HISTORY" + "\n";


                        $.each(data.history, function(key, value) {
                            all += value.date_received + "-" 
                            all += value.end_user + "\n";
                        })



                        console.log(all);
                        $('#qrcontent').val(all);

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