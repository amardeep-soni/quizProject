<?php
include_once "config.php";
$code = $_GET['code'];
$sql = mysqli_query($conn, "SELECT * FROM questions where quiz_code = '$code'");
if ($sql) {
    $row_num = mysqli_num_rows($sql);
    if (!$row_num) {
        echo 'no question';
    }
}
