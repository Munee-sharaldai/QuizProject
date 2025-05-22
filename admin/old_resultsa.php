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



        <div class="content mt-3">
            <div class="animated fadeIn">


                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <center>
            <h1>Прошлые результаты</h1>
        </center>
        <?php
        $count = 0;
        $res = mysqli_query($link, "SELECT * FROM quiz_results ORDER BY id DESC");
        
        if(!$res) {
            // Вывод ошибки SQL для отладки
            die("Ошибка запроса: " . mysqli_error($link));
        }
        
        $count = mysqli_num_rows($res);
        
        if ($count == 0) {
            ?>
            <center>
                <h1>Не найдено результатов</h1> 
            </center>
            <?php
        } else {
            echo "<table class='table table-bordered'>";
            echo "<tr style='background-color:rgb(0, 0, 0); color:white'>";
            echo "<th>Пользователь</th>";
            echo "<th>Название теста</th>";
            echo "<th>Всего вопросов</th>";
            echo "<th>Верных ответов</th>";
            echo "<th>Неверных ответов</th>";
            echo "<th>Время экзамена</th>";
            echo "</tr>";

            while($row = mysqli_fetch_array($res)) {
                echo "<tr>";
                echo "<td>".htmlspecialchars($row["username"])."</td>";
                echo "<td>".htmlspecialchars($row["quiz_type"])."</td>";
                echo "<td>".htmlspecialchars($row["total_question"])."</td>";
                echo "<td>".htmlspecialchars($row["correct_answer"])."</td>";
                echo "<td>".htmlspecialchars($row["wrong_answer"])."</td>";
                echo "<td>".htmlspecialchars($row["quiz_time"])."</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        ?>
                            </div>
                        </div>
                    </div>
                </div>


<?php
?>