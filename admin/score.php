<?php

session_start();
if (!$_SESSION['admin']) {
    header("Location: adminLogin.php");
}
$currentPage = "score";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="adminStyle.css">
    <title>Quiz App</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

</head>

<body id="quizBody">
    <?php include "adminNav.php"; ?>

    <div id="cont">
        <div id="tableCont">
            <h2>Scores</h2>
            <table id="table" class="table w-100">
                <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>Name</th>
                        <th>Quiz Code</th>
                        <th>Question Solved</th>
                        <th>Correct</th>
                        <th>Wrong</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "../php/config.php";
                    $sql = mysqli_query($conn, "SELECT * FROM score");
                    if ($sql) {
                        $rowNum = mysqli_num_rows($sql);
                        if ($rowNum) {
                            $count = 1;
                            while ($data = mysqli_fetch_assoc($sql)) {
                                echo "<tr>
                                <td>{$count}</td>
                                <td>{$data['name']}</td>
                                <td>{$data['quiz_code']}</td>
                                <td>{$data['question_solved']}</td>
                                <td>{$data['correct']}</td>
                                <td>{$data['wrong']}</td>
                            </tr>";
                                $count++;
                            }
                        } else {
                            echo "<tr><td colspan='6'>No any Score Found</td></tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>

</html>