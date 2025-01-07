<?php
require_once('system/db_config.php');
require_once("system/modules/userinteract.php");
?>

<header>
    <h1>Треним.ЕГЭ</h1>
    <?php
    $curr_user = new User();
    if($curr_user->auth()){
        echo("Здравствуйте, " . $curr_user->getUsername($_SESSION['uid']));
    }else{
        echo('<p><a href="login.php">Войти</a></p>');
    }
    ?>
</header>
<hr>