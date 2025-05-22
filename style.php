<?php
// Страница входа для администратора приложения "База данных "Школа""
//-----------------------------------------------------------
// Устанавливаем уровень оповещения ошибок
error_reporting(E_ALL); // Показывать все ошибки и предупреждения
session_start(); // Начинаем новую или открываем существующую сессию

// Переменные
$login = !empty($_POST['login']) ? $_POST['login'] : null;
$passwd = !empty($_POST['passwd']) ? $_POST['passwd'] : null;
$info = array();

// Скрипт
$date = date("d.m.y");
$dn = date("l");

if (!empty($_POST['ok'])) { // Если кнопка Отправить была нажата
    if (!$login) $info[] = 'Нет имени пользователя.';
    if (!$passwd) $info[] = 'Не введен пароль.';

    if (count($info) == 0) { // Если замечаний нет и все поля заполнены
        // Осуществляем удаление HTML-тегов и обратных слешей
        $login = htmlspecialchars(substr($login, 0, 50));
        $passwd = htmlspecialchars(substr($passwd, 0, 50));

        // Создаем соединение с базой данных MySQL
        $mysqli = new mysqli("localhost", "admin", "A082the", "userInfo");

        // Проверяем соединение
        if ($mysqli->connect_error) {
            die("Ошибка подключения: " . $mysqli->connect_error);
        }

        // Устанавливаем кодировку
        $mysqli->set_charset("utf8");

        $hash_val = md5($passwd); // Шифрование пароля

        // Подготовка запроса
        $stmt = $mysqli->prepare("SELECT userid FROM user_autentificate WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $login, $hash_val);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows !== 1) { // Если совпадение не найдено
            $info[] = 'Доступ запрещен.';
        } else { // Если проверка пройдена
            $stmt->bind_result($userid);
            $stmt->fetch();

            // Заносим логин в сессию
            $_SESSION['idsess'] = $login;
            $_SESSION['hashpasswd'] = $hash_val;

            // Запрос к базе данных для получения данных пользователя
            $stmt2 = $mysqli->prepare("SELECT adminname, adminsecname FROM user_data WHERE fuserid = ?");
            $stmt2->bind_param("i", $userid);
            $stmt2->execute();
            $result = $stmt2->get_result();

            if ($result->num_rows !== 1) {
                $info[] = 'Ошибка в базе.';
            } else { // Если данные найдены
                $row = $result->fetch_assoc();
                $_SESSION['name'] = $row["adminname"];
                $_SESSION['secname'] = $row["adminsecname"];

                // Пересылаем пользователя на страницу редактирования
                header('Location: base.php');
                exit();
            }

            $stmt2->close();
        }

        $stmt->close();
        $mysqli->close();
    }
}

// Отображение
echo chr(239) . chr(187) . chr(191);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>База данных "Авиакомпания"</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="description" content="База данных 'Школа'"/>
    <meta name="keywords" content="База данных, школа, PHP, MySQL, web-программирование"/>
    <link rel="stylesheet" type="text/css" href="my-style.css"/>
</head>
<body>
<div id="container">
    <div id="top">
    </div>
    <div id="other">
        <div id="daydata">
            <?php echo "Сегодня " . $date . " " . $dn; // вывод даты и дня недели ?>
        </div>
    </div>
    <div id="menu">
        <div><a href="index.php">Главная</a></div>
        <div><a href="adm.php" style="border-bottom: 7px solid #000066">Администрирование</a></div>
    </div>
    <div id="content">
               <h1>Вход для администраторов</h1>
        <p class="centr">Введите следующие данные:</p>
        <!-- Начало формы ввода пользовательских данных -->
        <form method="post" action="">
            <table border="0" align="center">
                <tr>
                    <td align="right">Логин:</td>
                    <td><input type="text" size="30" name="login" required/></td>
                </tr>
                <tr>
                    <td align="right">Пароль:</td>
                    <td><input type="password" size="30" name="passwd" required/></td>
                </tr>
            </table>
            <br/>
            <p class="centr">
                <input type="submit" value="Войти!" name="ok"/>
                <input type="reset" value="Очистить"/>
            </p>
            <!-- Конец формы ввода пользовательских данных -->
        </form>
        <p class="error">
            <!-- Вывод информации об ошибках -->
            <?php
            if (!empty($info)) {
                echo implode('<br/>', $info);
            }
            ?>
        </p>
        <br/>
    </div>
    <div id="footer">
        <p>Идея и реализация проекта &copy; istu.edu 2010
            <br/>
            <a href="advert.php">Информация для рекламодателей.</a>
            <br/>
            По любым вопросам: <a href="mailto:your@e-mail.ru">your@e-mail.ru</a>
        </p>
    </div>
</div>
</body>
</html>