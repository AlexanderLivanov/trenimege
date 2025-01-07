<?php
require_once('system/db_config.php');
require_once("system/modules/userinteract.php");
?>

<header>
    <h1>Треним.ЕГЭ</h1>
    <?php
    $user = new User();
    if($user->auth()){
        echo("Здравствуйте, " . $user->getUsername($_SESSION['uid']));
    }else{
        echo('<p><a href="login.php">Войти</a></p>');
    }
    ?>
</header>
<hr>