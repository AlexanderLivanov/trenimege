<?php
require_once('system/db_config.php');
require_once("system/modules/userinteract.php");
?>

<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="manifest" href="manifest.json">
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

        echo ('<div>
        <span class="material-icons">star</span>Звёздочки:' . $user_data['rating'] .
            '<br>
        <span class="material-icons">score</span>Общий счёт:' . $user_data['totalscore'] .
            '</div>');
    } else {
        echo ("Необходимо войти или зарегистрироваться");
    }

    ?>
</header>

<body>
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('/serviceWorker.js').then(function(registration) {
                    // Registration was successful
                    console.log('ServiceWorker registration successful with scope: ', registration.scope);
                }, function(err) {
                    // registration failed :(
                    console.log('ServiceWorker registration failed: ', err);
                }).catch(function(err) {
                    console.log(err)
                });
            });
        } else {
            console.log('service worker is not supported');
        }
    </script>
</body>