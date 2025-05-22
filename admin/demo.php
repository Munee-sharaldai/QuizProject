<?php
include "header.php";
include "../connection.php";
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


<?php
?>