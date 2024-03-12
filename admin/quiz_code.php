<?php

session_start();
if (!$_SESSION['admin']) {
    header("Location: adminLogin.php");
}
$currentPage = "quiz_code";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body id="quizBody">
    <?php include "adminNav.php"; ?>

    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Quiz</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form">
                        <div class="form-group">
                            <div id="error-txt">This is an Error message!</div>
                            <div id="success-txt">This is an Succes message!</div>
                            <label for="inputQuizCode">Quiz Code:</label>
                            <input type="text" class="form-control" name="quizCode" id="inputQuizCode">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="addChapBtn">Add Quiz</button>
                </div>
            </div>
        </div>
    </div>
    <div id="cont">
        <div id="tableCont">
            <div class="d-flex justify-content-between">
                <h2>Quizes</h2>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
                    Add Quiz
                </button>
            </div>
            <table id="table" class="table w-100">
                <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>Quiz Code</th>
                        <th>Total Questions</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "../php/config.php";
                    $sql = mysqli_query($conn, "SELECT * FROM quiz_names");
                    if ($sql) {
                        $rowNum = mysqli_num_rows($sql);
                        if ($rowNum) {
                            $count = 1;
                            while ($data = mysqli_fetch_assoc($sql)) {
                                $sql2 = mysqli_query($conn, "SELECT * FROM questions WHERE quiz_code = '{$data['quiz_code']}'");
                                if ($sql2) {
                                    $rowNum = mysqli_num_rows($sql);
                                    $countQues = 0;
                                    if ($rowNum) {
                                        while ($data2 = mysqli_fetch_assoc($sql2)) {
                                            $countQues++;
                                        }
                                    } else {
                                        $countQues = 0;
                                    }
                                    echo "<tr>
                                            <td>{$count}</td>
                                            <td>{$data['quiz_code']}</td>
                                            <td>{$countQues}</td>
                                            <td>
                                                <a href='question.php?code={$data['quiz_code']}' title='View Questions' class='btn btn-dark'>Questions <i class='fa-solid fa-arrow-right'></i></a>
                                            </td>
                                        </tr>";
                                    $count++;
                                }
                            }
                        } else {
                            echo "<tr><td colspan='4'>No any Quiz Added</td></tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="js/addQuizCode.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>

</html>