<?php
include_once "../../php/config.php";
$chapter = mysqli_real_escape_string($conn, $_POST['chapter']);
$question = mysqli_real_escape_string($conn, $_POST['question']);
$option1 = mysqli_real_escape_string($conn, $_POST['option1']);
$option2 = mysqli_real_escape_string($conn, $_POST['option2']);
$option3 = mysqli_real_escape_string($conn, $_POST['option3']);
$option4 = mysqli_real_escape_string($conn, $_POST['option4']);
$correct = mysqli_real_escape_string($conn, $_POST['correct']);

if (!empty($chapter) && !empty($question) && !empty($option1) && !empty($option2) && !empty($option3) && !empty($option4) && !empty($correct)) {
    if ($correct == $option1 || $correct == $option2 || $correct == $option3 || $correct == $option4) {
        $sql = mysqli_query($conn, "INSERT INTO `questions`(`chapter`, `question`, `option1`, `option2`, `option3`, `option4`, `correct`) VALUES ('{$chapter}','{$question}','{$option1}','{$option2}','{$option3}','{$option4}','{$correct}')");
        if ($sql) {
            echo "success";
        } else {
            echo "someting error occured!";
        }
    } else {
        echo "Please select the correct value according to Option";
    }
} else {
    echo "Please Fill all the Fields";
}
