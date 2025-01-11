<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Повтрояем формулы</title>
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <?php
    require_once('system/header.php');
    require_once('system/modules/logics.php');
    if (!$curr_user->auth()) {
        echo ("<script>setTimeout(function () { window.location.href = 'login.php'; });</script>");
    }

    $difficulty = 10;
    $questions = [];
    $correct_answers = [];

    $file = fopen("formulas.txt", "r");
    $f_arr = array();
    while (($line = fgets($file)) !== false) {
        $parts = explode(":", $line);
        $f = new Formula($parts[0], $parts[1], "1");
        // print_r($f->getF());
        array_push($f_arr, $f);
        // echo('<img src="http://latex.codecogs.com/svg.latex?' . $parts[1] . '" border="1" style="padding: .5em;" />');
        // echo "<br>";
    }
    echo ("<pre>");
    $keys = array_rand($f_arr, min($difficulty, count($f_arr)));
    foreach ((array)$keys as $key) {
        array_push($questions, $f_arr[$key]->formula_text);
        $choice = array_rand(['True', 'False', 'False', 'False', 'False']);
        if ($choice == 1) {
            array_push($correct_answers, "no");
            // echo ($f_arr[$key]->formula_text . " Changed<br><br>");
            // print_r($f->changeF($difficulty));
        } else {
            // echo ($f_arr[$key]->formula_text . " NotChanged <br><br>");
            array_push($correct_answers, "yes");
        }
    }

    echo ("</pre>");
    fclose($file);
    // print_r($correct_answers);
    ?>

    <?php
    require_once('system/footer.php');
    ?>
</body>

</html>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Тест с формулами</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function changeF(formula) {
            return formula + " + изменено";
        }

        $(document).ready(function() {
            let correctCount = 0;

            $('input[type=radio]').on('change', function() {
                const questionIndex = $(this).data('index');
                const selectedValue = $(this).val();
                const correctAnswer = $(this).data('correct');
                const originalFormula = <?= json_encode($questions) ?>[questionIndex];
                const modifiedFormula = changeF(originalFormula);

                if (selectedValue === correctAnswer) {
                    $('#result-' + questionIndex).text('Правильно!').css('color', 'green');
                    correctCount++;
                } else if (selectedValue === 'yes' && modifiedFormula !== originalFormula) {
                    $('#result-' + questionIndex).text('Неправильно!').css('color', 'red');
                } else {
                    $('#result-' + questionIndex).text('Неправильно!').css('color', 'red');
                }
                $('input[name="question' + questionIndex + '"]').attr('disabled', true);
                $('#score').text('Правильных ответов: ' + correctCount);
            });
        });
    </script>
</head>

<body>
    <form id="quiz-form" style="text-align: center;">
        <?php foreach ($questions as $index => $question): ?>
            <div>
                <p><?php echo('<img src="http://latex.codecogs.com/svg.latex?' . $question . '" border="1" style="padding: .5em;" />') ?></p>
                <label>
                    <input type="radio" name="question<?= $index ?>" value="yes" data-index="<?= $index ?>" data-correct="<?= $correct_answers[$index] ?>">
                    Да
                </label>
                <label>
                    <input type="radio" name="question<?= $index ?>" value="no" data-index="<?= $index ?>" data-correct="<?= $correct_answers[$index] ?>">
                    Нет
                </label>
                <div id="result-<?= $index ?>"></div>
                <hr>
            </div>
        <?php endforeach; ?>
    </form>

    <h3 id="score">Правильных ответов: 0</h3>

</body>

</html>