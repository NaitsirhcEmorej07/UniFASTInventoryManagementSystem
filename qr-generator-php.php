<?php
include ("connections/db-connect.php");


      $query = "select id from " . $TBL_INVENTORY . "";
      $result = mysqli_query($conn, $query);
      $countrow = mysqli_num_rows($result);

      while ($row = mysqli_fetch_array($result))
      {
            $rows[] =  $row["id"];

            
            
      }

      foreach($rows as $x)
            {
                  require_once 'phpqrcode/qrlib.php';

                  $path = 'qrcode/';
                  
                  $file = $path.uniqid().".png";
                  $input = "NAITSIRHC"; 
                  
                  QRcode::png($x, $file, 'H', 4, 1);
                  //png, input, file, ECC_LEVEL (L,M,Q,H), pixel size, frame size

                  echo "<img src='".$file."'>";
            }
      
            

                  
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
      
      <div id="qrcode">
        <?php
        foreach ($rows as $name) : ?>
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=90x90&data=<?= $name ?>" alt="">

        <?php
        endforeach;
        ?>
    </div>

</body>
</html>