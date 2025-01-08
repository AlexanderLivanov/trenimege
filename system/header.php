<?php
require_once('system/db_config.php');
require_once("system/modules/userinteract.php");
?>

<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<header>
    <h1>Треним.ЕГЭ</h1>
    <?php
    $curr_user = new User();
    $curr_db = new Database();
    if ($curr_user->auth()) {
        echo ("Здравствуйте, " . $curr_user->getUsername($_SESSION['uid']));
    } else {
        echo ('<p><a href="login.php">Войти</a></p>');
    }
    ?>
    <div>
        <span class="material-icons">star</span> 99
        <br>
        <span class="material-icons">score</span> 1337
    </div>
</header>
