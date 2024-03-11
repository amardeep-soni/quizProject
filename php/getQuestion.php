<?php
include_once "config.php";
$quid = $_GET['q'];
$code = $_GET['code'];
$output = array();
$sql = mysqli_query($conn, "SELECT * FROM questions where quiz_code = '$code'");
if ($sql) {
    $row_num = mysqli_num_rows($sql);
    $output['row'] = $row_num;
}
$sql2 = mysqli_query($conn, "SELECT * FROM questions where question_id = $quid AND quiz_code = '$code'");
if ($sql2) {
    $row_num = mysqli_num_rows($sql2);
    if ($row_num) {
        $row2 = mysqli_fetch_assoc($sql2);
        // echo 'question found' . $quid;
        $output["question"] = array($row2['question'], $row2['option1'], $row2['option2'], $row2['option3'], $row2['option4']);
    } else {
        $output["question"] = "no question";
    }
    echo json_encode($output);
    $output = '';
}
