<!-- 07.01.2025 (c) Alexander Livanov -->

<?php
require_once('system/db_config.php');
require_once('system/header.php');

if ($user->auth()) {
    echo ("<script>setTimeout(function () { window.location.href = 'main.php'; });</script>");
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = $db_connect->prepare("SELECT * FROM users WHERE username=:username");
    $query->bindParam("username", $username, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    if (!$result) {
        echo '<script>alert("Неправильный логин или пароль");</script>';
    } else {
        if (password_verify($password, $result['passwd_hash'])) {
            $user_token = $username . $password;
            $token = hash('sha256', $user_token);
            $_SESSION['uid'] = $result['id'];
            // $query = $db_connect->prepare("UPDATE users SET ip='" . $_SERVER['REMOTE_ADDR'] . "' WHERE username='" . $result['username'] . "'");
            $query->execute();
            setcookie("AUTH_TOKEN", $token, strtotime('+30 days'));
            header('Location: /main.php');
            exit();
        } else {
            echo '<script>alert("Неправильный логин или пароль");</script>';
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <title>Вход — FotosWorld</title>
</head>

<body>
    <div class="main-container">
        <h1>Вход в систему</h1>
        <form method="post" action="" name="signin-form">
            <div class="form-element">
                <input type="text" name="username" pattern="[A-Za-z._-1234567890]{4,}" required placeholder="Имя пользователя" />
            </div>
            <div class="form-element">
                <input type="password" name="password" required placeholder="Код для входа" />
            </div>
            <button type="submit" name="login" value="login">Войти</button>
            <p>Ещё нет аккаунта? <a href="new.php" class="white-link">Зарегистрируйтесь</a></p>
        </form>
    </div>
</body>

</html>