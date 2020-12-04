<?php

//варианты окончаний для слова "раз"
$forms = ["", "a", ""];

/**
*Функция для формирования слова правильного числа (множественного или единственного) слова
*@param принимает $n - кличество сущности; $forms - ее возможные окончания
*@return возвращает нужное окончание для слова
*/
function plural_form($n, $forms) {
    return $n%10==1&&$n%100!=11?$forms[0]:($n%10>=2&&$n%10<=4&&($n%100<10||$n%100>=20)?$forms[1]:$forms[2]);
}

/**
*Функция реализует простейший калькулятор
*@param принимает $number1 и $number2 - операнды; $operation - оператор
*@return возвращает числовой результат операции
*/
function calculate($number1, $number2, $operation)
    {
        switch ($_POST['operation']) {
            case 'plus':
                return $number1 + $number2;
            case  'minus':
                return $number1 - $number2;
            case 'multiply':
                return $number1 * $number2;
           case 'split':
            return round($number1 / $number2, 2);
        }
    }

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log[in]off test</title>
</head>
<body>
    <h2>Задание 1</h2>
    <p>Есть файл image.php, пусть он выводит любое изображение. Мы включаем его на страницу img src="image.php". Нужно знать, сколько раз мы его показали.</p>
    <img src="image.php">
    <?php
        if (!empty($_COOKIE) && isset($_COOKIE['i'])) { ?>
            <p>Изображение загружено на эту страницу <?= $_COOKIE['i'] . " раз" . plural_form($_COOKIE['i'], $forms) ?></p>
        <?php } else { ?>
            <p>Перезагрузите страницу для запуска счетчика</p>
            <p><b>*для счетчика я использовал куки, поэтому для получения первого значения (1) нужно перезагрузить страницу (жду обратного хита)</b></p>
       <?php }
    ?>

    <h2>Задание 2</h2>
    <p>Создать форму-калькулятор c операциями: сложение, вычитание, умножение, деление. Выбор операции можно осуществлять с помощью тега select</p>
    <div class="calc">
        <form method="post" action="/">
            <input autocomplete="off" name="first_num" type="number">
            <select name="operation">
                <option value="plus">+</option>
                <option value="minus">-</option>
                <option value="multiply">*</option>
                <option value="split">/</option>
            </select>
            <input autocomplete="off" name="second_num" type="number">
            <input type="submit" name="enter" value="=">
            <div class="result">
                <p>Результат <?= $_POST['first_num'] . " " . $_POST['operation'] . " " . $_POST['second_num'] ?> = </p>
                <b>
                <?php
                if (!is_numeric($_POST['first_num']) || !is_numeric($_POST['second_num'])) {
                    echo "Калькулятор работает только с числами!";
                } else if (strlen($_POST['first_num']) > 10 || strlen($_POST['second_num']) > 10) {
                    echo "К сожалению, этот калькулятор не может работать с такими большими числами...";
                } else if (
                isset($_POST)
                && isset($_POST['first_num'])
                && isset($_POST['second_num'])
                && !empty($_POST['operation'])
                ) {
                    if ($_POST['second_num'] == 0 && $_POST['operation'] == 'split') {
                        echo "На ноль делить нельзя!";
                    } else {
                        echo calculate($_POST['first_num'], $_POST['second_num'], $_POST['operation']); 
                    }
                }
                ?>
                </b> 
            </div>
        </form>
    </div>
</body>
</html>