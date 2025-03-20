<?php
include "connection.php"; // Подключение к базе данных

if (isset($_POST["submit1"])) {
    // Считывание данных из формы
    $firstname = mysqli_real_escape_string($link, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($link, $_POST['lastname']);
    $username = mysqli_real_escape_string($link, $_POST['username']);
    $password = mysqli_real_escape_string($link, $_POST['password']);
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $contact = mysqli_real_escape_string($link, $_POST['contact']);

    // Проверка, существует ли пользователь
    $res = mysqli_query($link, "SELECT * FROM registration WHERE username='$username'");
    $count = mysqli_num_rows($res);

    if ($count > 0) {
        // Если пользователь уже существует
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    document.getElementById('failure').style.display = 'block';
                });
              </script>";
    } else {
        // Вставка данных в базу
        $query = "INSERT INTO registration (firstname, lastname, username, password, email, contact) 
                  VALUES ('$firstname', '$lastname', '$username', '$password', '$email', '$contact')";
        if (mysqli_query($link, $query)) {
            // Успешная регистрация
            echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                        document.getElementById('success').style.display = 'block';
                    });
                  </script>";
        } else {
            // Ошибка базы данных
            echo "Ошибка: " . mysqli_error($link);
        }
    }
}
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Register Now</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css?family=Play:400,700" rel="stylesheet">
    <link rel="stylesheet" href="css1/bootstrap.min.css">
    <link rel="stylesheet" href="css1/style.css">
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <div class="error-pagewrap">
        <div class="error-page-int">
            <div class="text-center custom-login">
                <h3>Register Now</h3>
            </div>
            <div class="content-error">
                <div class="hpanel">
                    <div class="panel-body">
                        <form action="" name="form1" method="post">
                            <div class="row">
                                <div class="form-group col-lg-12">
                                    <label>FirstName</label>
                                    <input type="text" name="firstname" class="form-control" required>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label>LastName</label>
                                    <input type="text" name="lastname" class="form-control" required>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label>Username</label>
                                    <input type="text" name="username" class="form-control" required>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label>Contact</label>
                                    <input type="text" name="contact" class="form-control" required>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" name="submit1" class="btn btn-success loginbtn">Register</button>
                            </div>
                            <div class="alert alert-success" id="success" style="margin-top: 10px; display: none;">
                                <strong>Success!</strong> Account registered successfully.
                            </div>
                            <div class="alert alert-danger" id="failure" style="margin-top: 10px; display: none;">
                                <strong>Error!</strong> Username already exists.
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
