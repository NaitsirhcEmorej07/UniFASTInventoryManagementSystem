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
        $names = ['naitsirc', 'jerome', 'espena'];
        foreach ($names as $name) : ?>
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=90x90&data=<?= $name ?>" alt="">

        <?php
        endforeach;
        ?>
    </div>

</body>

</html>