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
        $user = $curr_user->getDataByID($_SESSION['uid']);
        $user_data = json_decode($user['data'], true);

        echo('<div>
        <span class="material-icons">star</span>Звёздочки:' . $user_data['rating'] .
        '<br>
        <span class="material-icons">score</span>Общий счёт:' . $user_data['totalscore'] .
        '</div>');
    }else{
        echo("Необходимо войти или зарегистрироваться");
    }

    ?>
</header>