<?php 
$from_date = "2022-11-04";
$new_date = date('M d, Y', strtotime('+2 years', strtotime($from_date)));

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php echo($new_date); ?>
</body>
</html>