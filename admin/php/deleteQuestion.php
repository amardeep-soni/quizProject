<?php
include_once "../../php/config.php";
$id = mysqli_real_escape_string($conn, $_POST['id']);
$code = mysqli_real_escape_string($conn, $_POST['code']);
$sql = mysqli_query($conn, "DELETE FROM questions where `question_id`= '$id'");
include_once "./close_connection.php";
header("Location: ../question.php?code=" . $code);
