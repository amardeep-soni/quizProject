<?php
include_once "../../php/config.php";
$quizCode = mysqli_real_escape_string($conn, $_POST['quizCode']);
$question = mysqli_real_escape_string($conn, $_POST['question']);
$option1 = mysqli_real_escape_string($conn, $_POST['option1']);
$option2 = mysqli_real_escape_string($conn, $_POST['option2']);
$option3 = mysqli_real_escape_string($conn, $_POST['option3']);
$option4 = mysqli_real_escape_string($conn, $_POST['option4']);
$correct = mysqli_real_escape_string($conn, $_POST['correct']);
$id = mysqli_real_escape_string($conn, $_POST['id']);

if (!empty($quizCode) && !empty($question) && !empty($option1) && !empty($option2) && !empty($option3) && !empty($option4) && !empty($correct)) {
    if ($correct == $option1 || $correct == $option2 || $correct == $option3 || $correct == $option4) {

        if ($id == 0) {
            $sql = mysqli_query($conn, "INSERT INTO `questions`(`quiz_code`, `question`, `option1`, `option2`, `option3`, `option4`, `correct`) VALUES ('{$quizCode}','{$question}','{$option1}','{$option2}','{$option3}','{$option4}','{$correct}')");
            if ($sql) {
                echo "Added";
            } else {
                echo "someting error occured!";
            }
        } else {
            $sql = mysqli_query($conn, "UPDATE `questions` SET `quiz_code`='{$quizCode}', `question`='{$question}', `option1`='{$option1}', `option2`='{$option2}', `option3`='{$option3}', `option4`='{$option4}', `correct`='{$correct}' WHERE `question_id`='{$id}'");

            if ($sql) {
                echo "Edited";
            } else {
                echo "something error occurred!";
            }
        }
    } else {
        echo "Please select the correct value according to Option";
    }
} else {
    echo "Please Fill all the Fields";
}
