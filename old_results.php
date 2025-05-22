<?php
session_start();
include "header.php";
include "connection.php";
if (!isset($_SESSION["username"])) {
    ?> 
    <script type="text/javascript">
        window.location="login.php";
    </script>
    <?php
}
?>

<div class="row" style="margin: 0px; padding:0px; margin-bottom: 50px;">
    <div class="col-lg-6 col-lg-push-3" style="min-height: 500px; background-color: white;">
        <center>
            <h1>Прошлые результаты</h1>
        </center>
        <?php
        $count = 0;
        $res = mysqli_query($link, "SELECT * FROM quiz_results WHERE username='".mysqli_real_escape_string($link, $_SESSION['username'])."' ORDER BY id DESC");
        
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
            echo "<tr style='background-color: #006df0; color:white'>";
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

<?php
include "footer.php";
?>