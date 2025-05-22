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
$id=$_GET["id"];
$id1=$_GET["id1"];
$questions="";
$opt1="";
$opt2="";
$opt3="";
$opt4="";
$answer="";

$res=mysqli_query($link, "select * from questions where id=$id");
while($row=mysqli_fetch_array($res)) {
    $question=$row["question"];
    $opt1=$row["opt1"];
    $opt2=$row["opt2"];
    $opt3=$row["opt3"];
    $opt4=$row["opt4"];
    $answer=$row["answer"];
}
?>
<!-- Header-->

<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Редактировать вопрос</h1>
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
                            <form name="form1" action="" method="post" enctype="multipart/form-data">
                                <div class="card">
                                    <div class="card-header"><strong>Редактировать вопрос</strong></div>
                                    <div class="card-body card-block">
                                        <div class="form-group"><label for="company"
                                                class=" form-control-label">Вопрос</label>
                                            <input type="text" name="question" placeholder="Введите вопрос"
                                                class="form-control" value="<?php echo $question; ?>">
                                        </div>
                                        <div class="form-group"><label for="company" class=" form-control-label">Вариант
                                                ответа 1</label>
                                            <input type="text" name="opt1" placeholder="Введите вариант ответа"
                                                class="form-control" value="<?php echo $opt1; ?>">
                                        </div>
                                        <div class="form-group"><label for="company" class=" form-control-label">Вариант
                                                ответа 2</label>
                                            <input type="text" name="opt2" placeholder="Введите вариант ответа"
                                                class="form-control" value="<?php echo $opt2; ?>">
                                        </div>
                                        <div class="form-group"><label for="company" class=" form-control-label">Вариант
                                                ответа 3</label>
                                            <input type="text" name="opt3" placeholder="Введите вариант ответа"
                                                class="form-control" value="<?php echo $opt3; ?>">
                                        </div>
                                        <div class="form-group"><label for="company" class=" form-control-label">Вариант
                                                ответа 4</label>
                                            <input type="text" name="opt4" placeholder="Введите вариант ответа"
                                                class="form-control" value="<?php echo $opt4; ?>">
                                        </div>
                                        <div class="form-group"><label for="company"
                                                class=" form-control-label">Ответ</label>
                                            <input type="text" name="answer" placeholder="Введите ответ"
                                                class="form-control" value="<?php echo $answer; ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" name="submit1" value="Обновить вопрос"
                                                class="btn btn-success">
                                        </div>
                                    </div>
                                </div>
                              </form>
                            </div>
                        </div>
                    </form>
                </div>
                <?php
                if(isset($_POST["submit1"])) {
                    mysqli_query($link, "update questions set question='$_POST[question]',opt1='$_POST[opt1]',opt2='$_POST[opt2]',opt3='$_POST[opt3]',opt4='$_POST[opt4]',answer='$_POST[answer]' where id=$id");
                    ?> 
                    <script type="text/javascript">
                        window.location="add_que.php?id=<?php echo $id1 ?>";
                    </script>
                    <?php
                }
                ?>
                <?php
                include "footer.php"
                ?>