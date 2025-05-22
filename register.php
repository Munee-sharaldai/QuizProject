<?php
include "connection.php";

if (isset($_POST["submit1"])) {
    $firstname = mysqli_real_escape_string($link, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($link, $_POST['lastname']);
    $username = mysqli_real_escape_string($link, $_POST['username']);
    $password = mysqli_real_escape_string($link, $_POST['password']);
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $contact = mysqli_real_escape_string($link, $_POST['contact']);

    $res = mysqli_query($link, "SELECT * FROM registration WHERE username='$username'");
    $count = mysqli_num_rows($res);

    if ($count > 0) {
        echo "<script>
                $(document).ready(function() {
                    $('#failure').fadeIn().delay(3000).fadeOut();
                });
              </script>";
    } else {
        $query = "INSERT INTO registration (firstname, lastname, username, password, email, contact) 
                  VALUES ('$firstname', '$lastname', '$username', '$password', '$email', '$contact')";
        if (mysqli_query($link, $query)) {
            echo "<script>
                    $(document).ready(function() {
                        $('#success').fadeIn().delay(3000).fadeOut(function() {
                            window.location.href = 'login.php';
                        });
                    });
                  </script>";
        } else {
            echo "<script>
                    $(document).ready(function() {
                        $('#failure').text('Ошибка базы данных: ".addslashes(mysqli_error($link))."').fadeIn();
                    });
                  </script>";
        }
    }
}
?>

<!doctype html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Регистрация | Система тестирования</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
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
        
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: all 0.3s ease;
            width: 100%;
            max-width: 600px;
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
        
        .btn-register {
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
        }
        
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(78, 115, 223, 0.4);
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
        
        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            color: var(--text-color);
        }
        
        .login-link a {
            color: var(--primary-color);
            font-weight: 500;
        }
        
        .alert {
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card animate__animated animate__fadeIn">
            <div class="card-header">
                <h3><i class="fas fa-user-plus me-2"></i>Создать аккаунт</h3>
            </div>
            <div class="card-body">
                <form action="" name="form1" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group input-icon">
                                <i class="fas fa-user"></i>
                                <input type="text" name="firstname" class="form-control" placeholder="Имя" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group input-icon">
                                <i class="fas fa-user"></i>
                                <input type="text" name="lastname" class="form-control" placeholder="Фамилия" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group input-icon">
                        <i class="fas fa-at"></i>
                        <input type="text" name="username" class="form-control" placeholder="Логин" required>
                    </div>
                    
                    <div class="form-group input-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" class="form-control" placeholder="Пароль" required>
                    </div>
                    
                    <div class="form-group input-icon">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                    
                    <div class="form-group input-icon">
                        <i class="fas fa-phone"></i>
                        <input type="text" name="contact" class="form-control" placeholder="Телефон" required>
                    </div>
                    
                    <button type="submit" name="submit1" class="btn btn-register">
                        <i class="fas fa-user-plus me-2"></i>Зарегистрироваться
                    </button>
                    
                    <div class="alert alert-success mt-4" id="success" style="display: none;">
                        <i class="fas fa-check-circle me-2"></i><strong>Успех!</strong> Аккаунт успешно создан.
                    </div>
                    
                    <div class="alert alert-danger mt-4" id="failure" style="display: none;">
                        <i class="fas fa-exclamation-circle me-2"></i><strong>Ошибка!</strong> Такой логин уже существует.
                    </div>
                    
                    <div class="login-link">
                        Уже есть аккаунт? <a href="login.php">Войти</a>
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