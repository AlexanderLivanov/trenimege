<!-- 07.01.2025 (c) Alexander Livanov -->

<?php
require_once('system/db_config.php');
require_once('system/header.php');

if ($curr_user->auth()) {
    echo ("<script>setTimeout(function () { window.location.href = 'main.php'; });</script>");
}

if (!empty($_POST['register'])) {

    $connect = dbConnect();

    $username = $_POST['username'];
    $_SESSION['username'] = $username;
    $passwd = $_POST['passwd'];
    $fi = $_POST['fi'];
    $local_datetime = getServerTime();
    $passwd_hash = password_hash($passwd, PASSWORD_BCRYPT);
    $user_token = $username . $passwd;
    $token = hash('sha256', $user_token);
    $token_hash = hash('sha256', $token);
    $array = array(
        'fi' => $fi,
        'regdate' => $local_datetime,
        'lastactivity' => $local_datetime,
        'rating' => 0,
        'totalscore' => 0
    );

    $json_data = json_encode($array, JSON_UNESCAPED_UNICODE);

    $query = $connect->prepare("SELECT * FROM users WHERE username=:username");
    $query->bindParam("username", $username, PDO::PARAM_STR);
    $query->execute();

    if ($query->rowCount() > 0) {
        echo ('<script>alert("Это имя пользователя занято. Придумайте другое");</script>');
    }
    if ($query->rowCount() == 0) {
        $query = $connect->prepare("INSERT INTO users(username, passwd_hash, token, data) VALUES 
                                                    (:username, :passwd_hash, :token_hash, :json_data);");
        $query->bindParam("username", $username, PDO::PARAM_STR);
        $query->bindParam("passwd_hash", $passwd_hash, PDO::PARAM_STR);
        $query->bindParam("token_hash", $token_hash, PDO::PARAM_STR);
        $query->bindParam("json_data", $json_data, PDO::PARAM_STR);
        $result = $query->execute();

        if ($result) {
            echo ('<p>ОК. Сейчас вы будете перенаправлены на страницу входа</p>');
            // allocStorage($username);
            // setDefaultAvatar($username);
            setcookie("AUTH_TOKEN", $token, strtotime('+30 days'));
            echo ("<script>setTimeout(function () { window.location.href = 'login.php'; }, 1000);</script>");
        } else {
            echo ('<script>alert("Проверьте форму ещё раз");</script>');
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
    <title>Создать аккаунт - FotosWorld</title>
</head>

<body>
    <div class="main-container">
        <form method="post" class="auth_form">
            <h1>Создание учётной записи</h1>
            <p id="op_status"></p>
            <div class="form-element">
                <input type="text" placeholder="Фамилия Имя" name="fi" pattern="[А-Яа-я ]{6,}" required>
            </div>
            <div class="form-element">
                <input type="text" placeholder="Имя пользователя" name="username" pattern="[A-Za-z._-1234567890]{4,}" required>
            </div>
            <div class="form-element">
                <input type="password" placeholder="Код для входа" name="passwd" pattern="[0-9]{4,}" required>
            </div>
            <button type="submit" name="register" value="register">Готово</button>
            <p>Уже есть аккаунт? <a href="login.php" class="white-link">Войдите</a></p>
        </form>
    </div>
</body>

</html>