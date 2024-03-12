<?php
include_once "../../php/config.php";
$id = mysqli_real_escape_string($conn, $_GET['id']);
$newStatus = mysqli_real_escape_string($conn, $_GET['newStatus']);
$sql = mysqli_query($conn, "UPDATE quiz_names SET `status` = '$newStatus' where `quiz_id`= '$id'");
include_once "./close_connection.php";
header("Location: ../quiz_code.php");
