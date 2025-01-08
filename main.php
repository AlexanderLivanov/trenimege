<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Тренируем ЕГЭ</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            background-color: #f5f5f5;
        }

        header,
        footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            background-color: #6200ea;
            color: white;
        }

        header .logo,
        footer .logo {
            display: flex;
            flex-direction: column;
            align-items: center;
            font-size: 24px;
        }

        .content {
            display: flex;
            padding: 15px;
            flex-grow: 1;
        }

        .main-content {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-template-rows: auto;
            gap: 15px;
            flex: 1;
        }

        .block {
            background-color: white;
            padding: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .block:hover {
            transform: scale(1.05);
        }

        .block.large {
            grid-column: span 2;
        }

        .leaderboard {
            width: 350px;
            margin-left: 15px;
            background-color: white;
            padding: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .leaderboard h3 {
            margin: 0 0 10px 0;
        }

        .leaderboard th,
        .leaderboard td {
            border: 1px solid #ccc;
            text-align: center;
        }

        .leaderboard .odd {
            background-color: white;
        }

        .leaderboard .even {
            background-color:rgb(244, 242, 242);
        }

        .leaderboard th {
            background-color: #e0e0e0;
        }

        
        footer {
            justify-content: center;
        }

        footer .logo {
            display: none;
        }

        footer p {
            margin: 0;
        }
    </style>
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
                <h2>Решаем задачи из банка ФИПИ</h2>
                <p>Их там пиздец как много</p>
            </div>
            <div class="block">
                <h2>Повторяем формулы</h2>
                <p>Изучено формул: 0/дохуя</p>
            </div>
            <div class="block">
                <h2>Пользовательские задачи</h2>
                <p>Для особо умных</p>
            </div>
            <div class="block large">
                <h2>Сгенерировать вариант ЕГЭ</h2>
                <p>Чтобы потратить 3 часа 55 минут своего времени</p>
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