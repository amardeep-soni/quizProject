<?php
include_once "../../php/config.php";
$chapter = mysqli_real_escape_string($conn, $_POST['chapter']);
if (!empty($chapter)) {
    $sql = mysqli_query($conn, "SELECT * FROM chapter where `chapter_name`= '$chapter'");
    if ($sql) {
        $row_num = mysqli_num_rows($sql);
        if ($row_num) {
            echo 'Chapter is already added!';
        } else {
            $sql2 = mysqli_query($conn, "INSERT INTO `chapter`(`chapter_name`) VALUES ('{$chapter}')");
            if ($sql2) {
                echo "success";
            } else {
                echo "someting error occured!";
            }
        }
    } else {
        echo "someting error occured!";
    }
} else {
    echo 'Please input Chapter Name';
}
