<?php
session_start();
include "connection.php";
$date=date("Y-m-d H:i:s");
$_SESSION["end_time"]=date("Y-m-d H:i:s", strtotime($date."+ $_SESSION[quiz_time] минут"));
include "header.php"
?>


        <div class="row" style="margin: 0px; padding:0px; margin-bottom: 50px;">

            <div class="col-lg-6 col-lg-push-3" style="min-height: 500px; background-color: white;">
                <?php 
                    $correct=0;
                    $wrong=0;

                    if(isset($_SESSION["answer"])) {
                        for($i=0;$i<=sizeof($_SESSION["answer"]);$i++) {
                            $answer="";
                            $res=mysqli_query($link,"select * from questions where category='$_SESSION[quiz_category]' && question_no=$i");
                            while($row=mysqli_fetch_array($res)) {
                                $answer=$row["answer"];
                            }
                        if(isset($_SESSION["answer"] [$i])) {
                            if($answer==$_SESSION["answer"] [$i]) {
                                $correct=$correct+1;
                            } else {
                                $wrong=$wrong+1;
                            }
                        } else{
                            $wrong=$wrong+1;
                        }
                        }
                    }

                    $count=0;
                    $res=mysqli_query($link,"select * from questions where category='$_SESSION[quiz_category]'");
                    $count=mysqli_num_rows($res);
                    $wrong=$count-$correct;
                    echo "<br>"; echo "<br>";
                    echo "<center>";

                        echo "Всего вопросов = ".$count;
                        echo "<br>";
                        echo "Верных ответов = ".$correct;
                        echo "<br>";
                        echo "Неверных ответов = ".$wrong;
                    echo "</center>";
                ?>
            </div>

        </div>

<?php 
if(isset($_SESSION["quiz_start"])) {
    $date=date("Y-m-d");
    mysqli_query($link, "insert into quiz_results(id,username,quiz_type,correct_answer,wrong_answer,quiz_time,total_question) 
    values(NULL, '$_SESSION[username]', '$_SESSION[quiz_category]', '$correct','$wrong','$date','$count')");

}
if(isset($_SESSION["quiz_start"])) {
    unset($_SESSION["quiz_start"]);
    ?> 
    <script type="text/javascript">
        window.location.href=window.location.href;
    </script>
    <?php
}
?>

<?php
include "footer.php"
?>