<?php
include "header.php";
include "../connection.php";

$id = $_GET["id"];
$quiz_category = '';

$stmt = $link->prepare("SELECT category FROM quiz_category WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($quiz_category);
$stmt->fetch();
$stmt->close();
?>
<!-- Header-->

<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Добавить вопрос <?php echo "<font color='red'>" . $quiz_category . "</font>"; ?></h1>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
    <div class="animated fadeIn">


        <div class="row">
            <div class="col-lg-12">
                <form name="form1" action="" method="post" enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-body">

                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header"><strong>Добавить новый вопрос</strong></div>
                                    <div class="card-body card-block">
                                        <div class="form-group"><label for="company"
                                                class=" form-control-label">Вопрос</label>
                                            <input type="text" name="question" placeholder="Введите вопрос"
                                                class="form-control">
                                        </div>
                                        <div class="form-group"><label for="company" class=" form-control-label">Вариант
                                                ответа 1</label>
                                            <input type="text" name="opt1" placeholder="Введите вариант ответа"
                                                class="form-control">
                                        </div>
                                        <div class="form-group"><label for="company" class=" form-control-label">Вариант
                                                ответа 2</label>
                                            <input type="text" name="opt2" placeholder="Введите вариант ответа"
                                                class="form-control">
                                        </div>
                                        <div class="form-group"><label for="company" class=" form-control-label">Вариант
                                                ответа 3</label>
                                            <input type="text" name="opt3" placeholder="Введите вариант ответа"
                                                class="form-control">
                                        </div>
                                        <div class="form-group"><label for="company" class=" form-control-label">Вариант
                                                ответа 4</label>
                                            <input type="text" name="opt4" placeholder="Введите вариант ответа"
                                                class="form-control">
                                        </div>
                                        <div class="form-group"><label for="company"
                                                class=" form-control-label">Ответ</label>
                                            <input type="text" name="answer" placeholder="Введите ответ"
                                                class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" name="submit1" value="Добавить вопрос"
                                                class="btn btn-success">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header"><strong>Добавить новый вопрос с картинкой</strong></div>
                                <div class="card-body card-block">
                                    <div class="form-group"><label for="company" class=" form-control-label">
                                            Вопрос</label>
                                        <input type="text" name="fquestion" placeholder="Введите вопрос"
                                            class="form-control">
                                    </div>
                                    <div class="form-group"><label for="company" class=" form-control-label">Вариант
                                            ответа 1</label>
                                        <input type="file" name="fopt1" class="form-control"
                                            style="padding-bottom:45px">
                                    </div>
                                    <div class="form-group"><label for="company" class=" form-control-label">Вариант
                                            ответа 2</label>
                                        <input type="file" name="fopt2" class="form-control"
                                            style="padding-bottom:45px">
                                    </div>
                                    <div class="form-group"><label for="company" class=" form-control-label">Вариант
                                            ответа 3</label>
                                        <input type="file" name="fopt3" class="form-control"
                                            style="padding-bottom:45px">
                                    </div>
                                    <div class="form-group"><label for="company" class=" form-control-label">Вариант
                                            ответа 4</label>
                                        <input type="file" name="fopt4" class="form-control"
                                            style="padding-bottom:45px">
                                    </div>
                                    <div class="form-group"><label for="company"
                                            class=" form-control-label">Ответ</label>
                                        <input type="file" name="fanswer" class="form-control"
                                            style="padding-bottom:45px">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="submit2" value="Добавить вопрос"
                                            class="btn btn-success">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-lg-12">
                        <form name="form1" action="" method="post" enctype="multipart/form-data">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>
                                                No
                                            </th>
                                            <th>
                                                Вопросы
                                            </th>
                                            <th>
                                                Вопрос №1
                                            </th>
                                            <th>
                                                Вопрос №2
                                            </th>
                                            <th>
                                                Вопрос №3
                                            </th>
                                            <th>
                                                Вопрос №4
                                            </th>
                                            <th>
                                                Редактировать
                                            </th>
                                            <th>
                                                Удалить
                                            </th>
                                        </tr>
                                        <?php
                                        $res = mysqli_query($link, "select * from questions where category='$quiz_category' order by question_no asc");
                                        while ($row = mysqli_fetch_array($res)) {
                                            echo "<tr>";
                                            echo "<td>";
                                            echo $row["question_no"];
                                            echo "</td>";
                                            echo "<td>";
                                            echo $row["question"];
                                            echo "</td>";
                                            echo "<td>";
                                            // Проверяем, является ли ответ изображением
                                            if (strpos($row["opt1"], 'opt_images/') !== false) {
                                                echo "<img src='" . $row["opt1"] . "' height='50' width='50'>";
                                            } else {
                                                echo $row["opt1"];
                                            }
                                            echo "</td>";
                                            echo "<td>";
                                            if (strpos($row["opt2"], 'opt_images/') !== false) {
                                                ?> <img src="<?php echo $row["opt2"]; ?>" height='50' width='50'> <?php
                                            } else {
                                                echo $row["opt2"];
                                            }
                                            echo "</td>";
                                            echo "<td>";
                                            if (strpos($row["opt3"], 'opt_images/') !== false) {
                                                echo "<img src='" . $row["opt3"] . "' height='50' width='50'>";
                                            } else {
                                                echo $row["opt3"];
                                            }
                                            echo "</td>";
                                            echo "<td>";
                                            if (strpos($row["opt4"], 'opt_images/') !== false) {
                                                echo "<img src='" . $row["opt4"] . "' height='50' width='50'>";
                                            } else {
                                                echo $row["opt4"];
                                            }
                                            echo "</td>";
                                            echo "<td>";
                                            if (strpos($row["opt4"], 'opt_images/') !== false) {
                                                ?> <a href="edit_option_images.php?id=<?php echo $row["id"]; ?>&id1=<?php echo $id; ?>">Edit</a> <?php
                                            } else {
                                                ?> <a href="edit_option.php?id=<?php echo $row["id"]; ?>&id1=<?php echo $id; ?>">Edit</a> <?php
                                            }
                                            echo "</td>";
                                            echo "<td>";
                                            ?> <a href="delete_option_images.php?id=<?php echo $row["id"]; ?>">Delete</a> <?php

                                               echo "</td>";


                                        }
                                        ?>
                                    </table>

                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if (array_key_exists("submit1", $_POST)) {
            $loop = 0;
            $count = 0;

            $res = mysqli_query($link, "SELECT * FROM questions WHERE category='$quiz_category' ORDER BY id ASC")
                or die(mysqli_error($link));

            $count = mysqli_num_rows($res);

            if ($count > 0) {
                while ($row = mysqli_fetch_array($res)) {
                    $loop = $loop + 1;
                    mysqli_query($link, "UPDATE questions SET question_no='$loop' WHERE id={$row['id']}");
                }
            }

            $loop = $loop + 1;

            mysqli_query($link, "INSERT INTO questions VALUES (
        NULL, '$loop', 
        '" . mysqli_real_escape_string($link, $_POST['question']) . "', 
        '" . mysqli_real_escape_string($link, $_POST['opt1']) . "', 
        '" . mysqli_real_escape_string($link, $_POST['opt2']) . "', 
        '" . mysqli_real_escape_string($link, $_POST['opt3']) . "', 
        '" . mysqli_real_escape_string($link, $_POST['opt4']) . "', 
        '" . mysqli_real_escape_string($link, $_POST['answer']) . "', 
        '$quiz_category'
    )") or die(mysqli_error($link));
            ?>
            <script type="text/javascript">
                alert("Вопрос успешно добавлен");
                window.location.href = window.location.href;
            </script>
            <?php
        }

        ?>
        <?php
        if (array_key_exists("submit2", $_POST)) {
            $loop = 0;
            $count = 0;

            $res = mysqli_query($link, "SELECT * FROM questions WHERE category='$quiz_category' ORDER BY id ASC")
                or die(mysqli_error($link));

            $count = mysqli_num_rows($res);

            if ($count > 0) {
                while ($row = mysqli_fetch_array($res)) {
                    $loop = $loop + 1;
                    mysqli_query($link, "UPDATE questions SET question_no='$loop' WHERE id={$row['id']}");
                }
            }

            $loop = $loop + 1;

            // Обработка загрузки изображений
            $upload_dir = "opt_images/";

            function uploadFile($file, $upload_dir)
            {
                if ($file['error'] === UPLOAD_ERR_OK) {
                    $tmp_name = $file["tmp_name"];
                    $name = basename($file["name"]);
                    $new_name = md5(time() . $name) . '.' . pathinfo($name, PATHINFO_EXTENSION);
                    move_uploaded_file($tmp_name, $upload_dir . $new_name);
                    return $upload_dir . $new_name;
                }
                return '';
            }

            $opt1_path = uploadFile($_FILES["fopt1"], $upload_dir);
            $opt2_path = uploadFile($_FILES["fopt2"], $upload_dir);
            $opt3_path = uploadFile($_FILES["fopt3"], $upload_dir);
            $opt4_path = uploadFile($_FILES["fopt4"], $upload_dir);
            $answer_path = uploadFile($_FILES["fanswer"], $upload_dir);

            mysqli_query($link, "INSERT INTO questions VALUES (
        NULL, '$loop', 
        '" . mysqli_real_escape_string($link, $_POST['fquestion']) . "', 
        '$opt1_path', 
        '$opt2_path', 
        '$opt3_path', 
        '$opt4_path', 
        '$answer_path', 
        '$quiz_category'
    )") or die(mysqli_error($link));
            ?>
            <script type="text/javascript">
                alert("Вопрос успешно добавлен");
                window.location.href = window.location.href;
            </script>
            <?php
        }

        ?>
        <?php
        include "footer.php"
            ?>