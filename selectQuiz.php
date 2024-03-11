<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
    header("Location: login.php");
}
$unique_id = $_SESSION['unique_id'];
$currentPage = "quiz";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>Quiz App</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

</head>

<body id="quizBody">

    <?php include_once 'nav.php' ?>

    <div class="cont">
        <div class="quiz-container p-4">
            <div id="error-txt">This is an error message!</div>
            <h2>Select Quiz</h2>
            <div class="selectValue">
                <?php
                include_once "php/config.php";
                $output = array();
                $sql = mysqli_query($conn, "SELECT * FROM quiz_names");
                if ($sql) {
                    $rowNum = mysqli_num_rows($sql);
                    if ($rowNum) {
                        while ($row = mysqli_fetch_assoc($sql)) {
                            $quizCode = ucfirst($row['quiz_code']);
                            echo "<a class='quizCode' href='quiz.php?code={$row['quiz_code']}' id='{$row['quiz_code']}' >$quizCode</a>";
                        }
                    } else {
                        echo "No any Quizes Found1";
                    }
                }
                ?>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>

</html>