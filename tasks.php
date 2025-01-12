<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <title></title>
</head>
<body>
    <?php 
    require_once('system/header.php');

    $url = 'https://ege.fipi.ru/bank/index.php?proj=BA1F39653304A5B041B656915DC36B38';
    $content = file_get_contents($url);
    $first_step = explode('<div class="qblock" id="q474F4B">', $content);
    $second_step = explode("</div>", $first_step[1]);

    echo $second_step[0];
    
    ?>

    
</body>
</html>