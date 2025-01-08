<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    require_once('system/header.php');
    if (!$curr_user->auth()) {
        echo ("<script>setTimeout(function () { window.location.href = 'login.php'; });</script>");
    }else{
        echo ("<script>setTimeout(function () { window.location.href = 'main.php'; });</script>");
    }
    ?>
    <h1>
        HELLO
    </h1>
    <?php
    require_once('system/footer.php');
    ?>
</body>

</html>
