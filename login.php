<?php
session_start();
include "connection.php";

if (isset($_POST["login"])) {
    $count = 0;
    $res = mysqli_query($link, "SELECT * FROM registration WHERE username='$_POST[username]' && password='$_POST[password]'");
    $count = mysqli_num_rows($res);
    if ($count == 0) {
        ?>
        <script type="text/javascript">
            document.getElementById("failure").style.display = "block";
        </script>
        <?php
    } else {
        $_SESSION["username"] = $_POST["username"];
        ?>
        <script type="text/javascript">
            window.location = "select_quiz.php"
        </script>
        <?php
    }
}
?>

<!doctype html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Вход в систему | Тестирование</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #f8f9fc;
            --accent-color: #2e59d9;
            --text-color: #5a5c69;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-color);
            padding: 20px;
        }

        .login-container {
            width: 100%;
            max-width: 500px;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
            color: white;
            text-align: center;
            padding: 2rem;
            border-bottom: none;
        }

        .card-header h3 {
            font-weight: 600;
            margin: 0;
            font-size: 1.8rem;
        }

        .card-body {
            padding: 2.5rem;
            background-color: white;
        }

        .form-control {
            height: 50px;
            border-radius: 8px;
            border: 1px solid #e3e6f0;
            padding-left: 20px;
            margin-bottom: 1.5rem;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }

        .btn-login {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
            border: none;
            color: white;
            padding: 12px 30px;
            font-size: 1.1rem;
            border-radius: 8px;
            width: 100%;
            transition: all 0.3s;
            font-weight: 500;
            letter-spacing: 0.5px;
            margin-bottom: 15px;
        }

        .btn-register {
            background: white;
            border: 1px solid var(--primary-color);
            color: var(--primary-color);
            padding: 12px 30px;
            font-size: 1.1rem;
            border-radius: 8px;
            width: 100%;
            transition: all 0.3s;
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(78, 115, 223, 0.4);
        }

        .btn-register:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
        }

        .input-icon {
            position: relative;
        }

        .input-icon i {
            position: absolute;
            left: 15px;
            top: 15px;
            color: #d1d3e2;
            z-index: 10;
        }

        .input-icon input {
            padding-left: 45px;
        }

        .alert {
            border-radius: 8px;
            margin-top: 20px;
        }

        .form-group label {
            font-weight: 500;
            margin-bottom: 8px;
            display: block;
        }

        /* Добавьте этот стиль в ваш существующий CSS */
        .form-group {
            width: 100%;
        }

        .form-control {
            width: 100%;
            /* Добавлено */
            box-sizing: border-box;
            /* Важно для правильного расчета ширины с padding */
        }
.auth-buttons {
    display: flex;
    flex-direction: column;
    gap: 10px; /* Уменьшили расстояние между кнопками */
    width: 100%;
}

.btn {
    padding: 12px;
    font-size: 1.1rem;
    border-radius: 8px;
    width: 100%;
    transition: all 0.3s;
    font-weight: 500;
    letter-spacing: 0.5px;
    text-align: center;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-sizing: border-box; 
}

.btn-login {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
    border: none;
    color: white;
    margin-bottom: 0;
}

.btn-register {
    background: white;
    border: 1px solid var(--primary-color);
    color: var(--primary-color);
    margin-top: 0; 
}

.btn i {
    margin-right: 8px;

}
    </style>
</head>

<body>
    <div class="login-container">
        <div class="card animate__animated animate__fadeIn">
            <div class="card-header">
                <h3><i class="fas fa-sign-in-alt me-2"></i>Вход в систему</h3>
            </div>
            <div class="card-body">
                <form action="" name="form1" method="post">
                    <div class="form-group">
                        <label for="username">Логин</label>
                        <div class="input-icon">
                            <i class="fas fa-user"></i>
                            <input type="text" placeholder="Введите ваш логин" required name="username" id="username"
                                class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">Пароль</label>
                        <div class="input-icon">
                            <i class="fas fa-lock"></i>
                            <input type="password" placeholder="Введите ваш пароль" required name="password"
                                id="password" class="form-control">
                        </div>
                    </div>

<div class="auth-buttons">
    <button type="submit" name="login" class="btn btn-login">
        <i class="fas fa-sign-in-alt me-2"></i>Войти
    </button>
    
    <a href="register.php" class="btn btn-register">
        <i class="fas fa-user-plus me-2"></i>Зарегистрироваться
    </a>
</div>

                    <div class="alert alert-danger" id="failure" style="display: none;">
                        <i class="fas fa-exclamation-circle me-2"></i><strong>Ошибка!</strong> Неверный логин или
                        пароль!
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- jQuery и Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>