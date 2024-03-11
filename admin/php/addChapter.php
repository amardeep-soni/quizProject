<?php
include_once "../../php/config.php";
$quizCode = mysqli_real_escape_string($conn, $_POST['quizCode']);
if (!empty($quizCode)) {
    $sql = mysqli_query($conn, "SELECT * FROM quiz_Names where `quiz_code`= '$quizCode'");
    if ($sql) {
        $row_num = mysqli_num_rows($sql);
        if ($row_num) {
            echo 'Choose different Quiz Code!';
        } else {
            $sql2 = mysqli_query($conn, "INSERT INTO `quiz_Names`(`quiz_code`) VALUES ('{$quizCode}')");
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
    echo 'Please input Quiz Code';
}
