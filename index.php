<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Треним.ЕГЭ</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <?php
    require_once("system/header.php");
    if ($user->auth()) {
        echo ("<script>setTimeout(function () { window.location.href = 'login.php'; });</script>");
    }
    ?>
</body>
</html>