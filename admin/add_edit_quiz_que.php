<?php
session_start();
include "header.php";
include "../connection.php";
$quiz_category = '';
$stmt = $link->prepare("SELECT category FROM quiz_category WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($quiz_category);
$stmt->fetch();
$stmt->close();
if(!isset($_SESSION["admin"])) {
    ?>
    <script type="text/javascript">
        window.location="index.php";
    </script>
    <?php
}
?>
<!-- Header-->

<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Выберите квиз для редактирования и добавления вопросов</h1>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
    <div class="animated fadeIn">


        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <form class="form1" action="" method="post">
                        <div class="card-body">

                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header"><strong>Редактировать квиз</strong></div>
                                    <div class="card-body card-block">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Название квиза</th>
                                                    <th scope="col">Время на прохождение квиза</th>
                                                    <th scope="col">Выбрать</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $count = 0;
                                                $res = mysqli_query($link, "select * from quiz_category");
                                                while ($row = mysqli_fetch_array($res)) {
                                                    $count = $count + 1;
                                                    ?>
                                                    <tr>
                                                        <th scope="row"><?php echo $count; ?></th>
                                                        <td><?php echo $row["category"] ?></td>
                                                        <td><?php echo $row["quiz_time_in_minutes"] ?></td>
                                                        <td><a
                                                                href="add_que.php?id=<?php echo $row["id"]; ?>">Выбрать</a>
                                                        </td>

                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <?php
                if (isset($_POST["submit1"])) {
                    mysqli_query($link, "update quiz_category set category='$_POST[quizname]', quiz_time_in_minutes='$_POST[quiztime]' where id=$id") or die(mysqli_error($link));
                    ?>
                    <script type="text/javascript">
                        window.location = "quiz_category.php";
                    </script>
                    <?php
                }
                ?>
                <?php
                ?>