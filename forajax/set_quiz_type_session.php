<?php
session_start();
include "../connection.php";
include "header.php";
$quiz_category=$_GET["quiz_category"];
$_SESSION["quiz_category"]=$quiz_category;
$res=mysqli_query($link, "select * from quiz_category where category='$quiz_category'");
while($row=mysqli_fetch_array($res)) {
    $_SESSION["quiz_time"]=$row["quiz_time_in_minutes"];
}
$date=date("Y-m-d H:i:s");
$_SESSION["end_time"]=date("Y-m-d H:i:s", strtotime($date."+$_SESSION[quiz_time] minutes"));
$_SESSION["quiz_start"]="yes";
?>


        <div class="row" style="margin: 0px; padding:0px; margin-bottom: 50px;">

            <div class="col-lg-6 col-lg-push-3" style="min-height: 500px; background-color: white;">

            </div>

        </div>

<?php
include "footer.php"
?>