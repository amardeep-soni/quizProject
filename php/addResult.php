<?php
session_start();
include 'config.php';
$chapter = $_GET['chap'];
$totalQuestion = $_GET['ques'];
$correct = $_GET['score'];
$wrong = $totalQuestion - $correct;

$sql = mysqli_query($conn, "SELECT * FROM score");
if ($sql) {
    $row_num = mysqli_num_rows($sql);
    if ($row_num) {
        $sql2 = mysqli_query($conn, "SELECT * FROM score WHERE `chapter`='{$chapter}'AND `unique_id` = {$_SESSION['unique_id']}");
        if ($sql2) {
            $row_num2 = mysqli_num_rows($sql2);
            if ($row_num2) {
                $data = mysqli_fetch_assoc($sql2);
                $newTotalQuestion = $data['question_solved'] + $totalQuestion;
                $newCorrect = $data['correct'] + $correct;
                $newWrong = $data['wrong'] + $wrong;
                $sql5 = mysqli_query($conn, "UPDATE `score` SET `question_solved`='{$newTotalQuestion}',`correct`='{$newCorrect}',`wrong`='{$newWrong}' WHERE `chapter` = '{$chapter}' AND `unique_id`={$_SESSION['unique_id']}");
                echo "yes chapter";
            } else {
                $sql6 = mysqli_query($conn, "INSERT INTO score(`unique_id`, `name`, `chapter`, `question_solved`, `correct`, `wrong`) VALUES ('{$_SESSION['unique_id']}','{$_SESSION['name']}','{$chapter}',$totalQuestion,$correct,$wrong)");
                echo "no chapter";
            }
        }
    } else {
        $sql8 = mysqli_query($conn, "INSERT INTO score(`unique_id`, `name`, `chapter`, `question_solved`, `correct`, `wrong`) VALUES ('{$_SESSION['unique_id']}','{$_SESSION['name']}','{$chapter}',$totalQuestion,$correct,$wrong)");
    }
}
