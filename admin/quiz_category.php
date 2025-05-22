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
?>
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Добавить квиз</h1>
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
                            <div class="card-header"><strong>Добавить квиз</strong></div>
                            <div class="card-body card-block">
                                <div class="form-group"><label for="company" class=" form-control-label">Новый квиз</label>
                                <input type="text" name="quizname" placeholder="Введите название квиза" class="form-control"></div>
                                <div class="form-group"><label for="vat" class=" form-control-label">Время на прохождение квиза</label>
                                <input type="text" name="quiztime" placeholder="Введите время на прохождение" class="form-control"></div>
                                <div class="form-group">
                                    <input type="submit" name="submit1" value="Добавить квиз" class="btn btn-success">
                                </div>
                                                    </div>
                                                </div>
                                            </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Категории Квизов</strong>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Название квиза</th>
                                            <th scope="col">Время на прохождение квиза</th>
                                            <th scope="col">Редактировать</th>
                                            <th scope="col">Удалить</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count=0;
                                    $res=mysqli_query($link,"select * from quiz_category");
                                    while($row=mysqli_fetch_array($res)){
                                        $count=$count+ 1;
                                        ?>
                                                                                <tr>
                                            <th scope="row"><?php echo $count;?></th>
                                            <td><?php echo $row["category"]?></td>
                                            <td><?php echo $row["quiz_time_in_minutes"]?></td>
                                            <td><a href="edit_quiz.php?id=<?php echo $row["id"];?>">Редактировать</a></td>
                                            <td><a href="delete.php?id=<?php echo $row["id"];?>">Удалить</a></td>
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
    if(isset($_POST["submit1"])) {
        mysqli_query($link, "insert into quiz_category values(NULL, '$_POST[quizname]','$_POST[quiztime]')") or die(mysqli_error($link));
        ?>
        <script type="text/javascript">
            alert("Quiz added successfully"); 
            window.location.href=window.location.href;
        </script>
        <?php
    }
?>
<?php
include "footer.php";
?>