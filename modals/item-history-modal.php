
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
    <div class="modal" id="item-history-modal" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true" data-bs-backdrop="false">
        <div class="modal-dialog modal-lg" style="top: 15%; ">
            <div class="modal-content">


                <form id="update_user_form">
                    <div class="modal-header" style="background-color: #e3f2fd;">
                        <h5 class="modal-title">ITEM HISTORY</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    
                    <div class="modal-body">
                        <input id="serialnumber" type="hidden">
                        <table id="tablehistory" class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 40%;">End User</th>
                                    <th style="width: 30%;">Date Recieved</th>
                                    <th style="width: 30%;">Status upon Receiving</th>
                                </tr>
                            </thead>

                            <tbody id="historybody">
                            </tbody>
                        </table>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

</html>