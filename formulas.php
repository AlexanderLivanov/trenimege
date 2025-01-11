<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Повтрояем формулы</title>
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <?php
    require_once('system/header.php');
    require_once('system/modules/logics.php');
    if (!$curr_user->auth()) {
        echo ("<script>setTimeout(function () { window.location.href = 'login.php'; });</script>");
    }

    $difficulty = 10;

    $file = fopen("formulas.txt", "r");
    $f_arr = array();
    while (($line = fgets($file)) !== false) {
        $parts = explode(":", $line);
        $f = new Formula($parts[0], $parts[1], "1");
        // print_r($f->getF());
        array_push($f_arr, $f);
        // echo('<img src="http://latex.codecogs.com/svg.latex?' . $parts[1] . '" border="1" style="padding: .5em;" />');
        // echo "<br>";
    }
    echo("<pre>");
    $keys = array_rand($f_arr, min($difficulty, count($f_arr)));
    foreach ((array)$keys as $key) {
        $choice = array_rand(['True', 'False', 'True', 'False', 'False']);
        if ($choice == 1 or $choice == 3) {
            print_r($f_arr[$key]->formula_text); 
            // print_r($f->changeF($difficulty));
        } else {
            print_r($f_arr[$key]->formula_text); 
        }
    }



    echo("</pre>");
    fclose($file);

    ?>

    <?php
    require_once('system/footer.php');
    ?>
</body>

</html>