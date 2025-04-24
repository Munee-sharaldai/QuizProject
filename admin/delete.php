<?php
include "../connection.php";
$id=$_GET["id"];
mysqli_query($link, "delete from quiz_category where id=$id");
?>
<script type="text/javascript">
    window.location="quiz_category.php";
</script>