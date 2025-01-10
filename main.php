<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Тренируем ЕГЭ</title>
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <?php
    require_once('system/header.php');
    if (!$curr_user->auth()) {
        echo ("<script>setTimeout(function () { window.location.href = 'login.php'; });</script>");
    }
    ?>
    <div class="content">
        <div class="main-content">
            <div class="block large">
                <a class="inactive" href="#">
                    <h2>Решаем задачи из банка ФИПИ</h2>
                    <p>Решено задач:</p>
                    <ul>
                        <li>Лёгких - 0</li>
                        <li>Средних - 0</li>
                        <li>Трудных - 0</li>
                    </ul>
                </a>
            </div>
            <div class="block active" onclick="window.open('/formulas.php', '_self')">
                <h2>Повторяем формулы</h2>
                <p>Всего повторено: 0</p>
            </div>
            <div class="block">
                <a class="inactive" href="#">
                    <h2>Пользовательские задачи</h2>
                    <p>Всего задач добавлено: 0</p>
                </a>
            </div>
            <div class="block large">
                <a class="inactive" href="#">
                    <h2>Сгенерировать вариант ЕГЭ</h2>
                    <p>Прорешать вариант полностью</p>
                </a>
            </div>

        </div>
        <div class="leaderboard">
            <h3>Лидерборд (ТОП-15)</h3>
            <table>
                <thead>
                    <tr>
                        <th>№</th>
                        <th>Ник</th>
                        <th>ФИ</th>
                        <th>Рейтинг</th>
                        <th>Общий счёт</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $all_users = $curr_db->fetchAllData("users");
                    $counter = 0;
                    foreach ($all_users as $user) {
                        $user_data = json_decode($user['data'], true);
                        if ($counter < 15) {
                            $counter++;
                            $class = ($counter % 2 == 0) ? 'even' : 'odd';
                            echo ("
                            <tr class=\"$class\">
                                <td>" . $counter . "</td>
                                <td>" . $user['username'] . "</td>
                                <td>" . $user_data['fi'] . "</td>
                                <td>" . $user_data['rating'] . "</td>
                                <td>" . $user_data['totalscore'] . "</td>
                            </tr>");
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <footer>
        <p>2021 - 2025 (c) <a style="color: white;" href="https://github.com/AlexanderLivanov">Alexander Livanov</a>
        <p>
    </footer>

</body>

</html>