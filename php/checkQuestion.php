<?php
include_once "config.php";
$chapter = $_GET['chap'];
$sql = mysqli_query($conn, "SELECT * FROM questions where chapter = '$chapter'");
if ($sql) {
    $row_num = mysqli_num_rows($sql);
    if (!$row_num) {
        echo 'no question';
    }
}
