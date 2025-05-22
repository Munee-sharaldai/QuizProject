<?php
session_start();
include "header.php";
include "../connection.php";
if(!isset($_SESSION["admin"])) {
    ?>
    <script type="text/javascript">
        window.location="index.php";
    </script>
    <?php
}
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
                        <h1>Редактировать квиз</h1>
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
                          
                            <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header"><strong>Редактировать квиз</strong></div>
                            <div class="card-body card-block">
                                <div class="form-group"><label for="company" class=" form-control-label">Новый квиз</label>
                                <input type="text" name="quizname" placeholder="Введите название квиза" class="form-control" value="<?php echo $quiz_category; ?>"></div>
                                <div class="form-group"><label for="vat" class=" form-control-label">Время на прохождение квиза</label>
                                <input type="text" name="quiztime" placeholder="Введите время на прохождение" class="form-control" value="<?php echo $quiz_time; ?>"></div>
                                <div class="form-group">
                                    <input type="submit" name="submit1" value="Обновить квиз" class="btn btn-success">
                                </div>
                                                    </div>
                                                </div>
                                            </div>
                            </div>
                            </form>
                        </div> 
<?php
    if(isset($_POST["submit1"])) {
        mysqli_query($link, "update quiz_category set category='$_POST[quizname]', quiz_time_in_minutes='$_POST[quiztime]' where id=$id") or die(mysqli_error($link));
        ?>
        <script type="text/javascript">
            window.location="quiz_category.php";
        </script>
        <?php
    }
?>
<?php
?>