<?php

session_start();
if (!$_SESSION['admin']) {
    header("Location: adminLogin.php");
}
$currentPage = "question";
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

    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Question</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form">
                        <div id="error-txt">This is an Error message!</div>
                        <div id="success-txt">This is an Succes message!</div>
                        <div class="form-group">
                            <select name="quizCode" class="form-control" id="selectQuizCode">
                                <option value="" selected>Select Quiz Code</option>
                                <?php
                                include "../php/config.php";
                                $sql = mysqli_query($conn, "SELECT * FROM quiz_names");
                                if ($sql) {
                                    $rowNum = mysqli_num_rows($sql);
                                    if ($rowNum) {
                                        $count = 1;
                                        while ($data = mysqli_fetch_assoc($sql)) {
                                            echo "<option value='{$data['quiz_code']}'>{$data['quiz_code']}</option>";
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <!-- <label for="inputQuestion">Question</label> -->
                            <input type="text" class="form-control" name="question" id="inputQuestion" placeholder="Question">
                        </div>
                        <div class="form-group">
                            <!-- <label for="inputOption1">Option1</label> -->
                            <input type="text" class="form-control" name="option1" id="inputOption1" placeholder="Option 1">
                        </div>
                        <div class="form-group">
                            <!-- <label for="inputOption2">Option2</label> -->
                            <input type="text" class="form-control" name="option2" id="inputOption2" placeholder="Option 2">
                        </div>
                        <div class="form-group">
                            <!-- <label for="inputOption3">Option3</label> -->
                            <input type="text" class="form-control" name="option3" id="inputOption3" placeholder="Option 3">
                        </div>
                        <div class="form-group">
                            <!-- <label for="inputOption4">Option4</label> -->
                            <input type="text" class="form-control" name="option4" id="inputOption4" placeholder="Option 4">
                        </div>
                        <div class="form-group">
                            <!-- <label for="inputCorrect">Correct</label> -->
                            <input type="text" class="form-control" name="correct" id="inputCorrect" placeholder="Correct">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="addQuesBtn">Add Question</button>
                </div>
            </div>
        </div>
    </div>
    <div id="cont">
        <div id="tableCont">
            <div class="d-flex justify-content-between">
                <h2>Questions</h2>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
                    Add Question
                </button>
            </div>
            <table id="table" class="table w-100">
                <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>Quiz Code</th>
                        <th>Question</th>
                        <th>Option1</th>
                        <th>Option2</th>
                        <th>Option3</th>
                        <th>Option4</th>
                        <th>Correct</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "../php/config.php";
                    $sql = mysqli_query($conn, "SELECT * FROM questions");
                    if ($sql) {
                        $rowNum = mysqli_num_rows($sql);
                        if ($rowNum) {
                            $count = 1;
                            while ($data = mysqli_fetch_assoc($sql)) {
                                echo "<tr>
                                <td>{$count}</td>
                                <td>{$data['quiz_code']}</td>
                                <td>{$data['question']}</td>
                                <td>{$data['option1']}</td>
                                <td>{$data['option2']}</td>
                                <td>{$data['option3']}</td>
                                <td>{$data['option4']}</td>
                                <td>{$data['correct']}</td>
                            </tr>";
                                $count++;
                            }
                        } else {
                            echo "<tr><td colspan='8'>No any Question Added</td></tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="js/addQuestion.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>

</html>