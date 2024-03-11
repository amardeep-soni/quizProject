<?php

session_start();
if (isset($_GET['q']) && isset($_GET['code']) && isset($_GET['r'])) {
    if ($_GET['r'] == 'undefined') {
        echo "not selected";
    } else {
        include_once "config.php";
        $sql2 = mysqli_query($conn, "SELECT * FROM questions where question_id = {$_GET['q']} AND quiz_code = '{$_GET['code']}'");
        if ($sql2) {
            $row = mysqli_fetch_assoc($sql2);
            if ($row) {
                if ($_GET['r'] == $row['correct']) {
                    echo "correct";
                } else {
                    echo "incorrect";
                }
            }
        }
    }
} else {
    header("Location: quiz.php");
}
