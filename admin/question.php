<?php

session_start();
if (!$_SESSION['admin']) {
    header("Location: adminLogin.php");
}
$code = $_GET["code"];
$currentPage = 'question';
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

    <div class="modal fade" id="addQuestion" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="addQuestionLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addQuestionLabel">Add Question</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addQuestionForm">
                        <div id="error-txt">This is an Error message!</div>
                        <div id="success-txt">This is an Succes message!</div>
                        <div class="form-group">
                            <input type="text" id="idInput" value='0' name='id' hidden>
                            <label for="inputQuizCode">Quiz Code</label>
                            <input type="text" class="form-control" name="quizCode" id="inputQuizCode" placeholder="Quiz Code" value="<?php echo $code ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="inputQuestion">Question</label>
                            <input type="text" class="form-control" name="question" id="inputQuestion" placeholder="Question">
                        </div>
                        <div class="form-group">
                            <label for="inputOption1">Option1</label>
                            <input type="text" class="form-control" name="option1" id="inputOption1" placeholder="Option 1">
                        </div>
                        <div class="form-group">
                            <label for="inputOption2">Option2</label>
                            <input type="text" class="form-control" name="option2" id="inputOption2" placeholder="Option 2">
                        </div>
                        <div class="form-group">
                            <label for="inputOption3">Option3</label>
                            <input type="text" class="form-control" name="option3" id="inputOption3" placeholder="Option 3">
                        </div>
                        <div class="form-group">
                            <label for="inputOption4">Option4</label>
                            <input type="text" class="form-control" name="option4" id="inputOption4" placeholder="Option 4">
                        </div>
                        <div class="form-group">
                            <label for="inputCorrect">Correct</label>
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

    <div class="modal fade" id="deleteQuestion" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="deleteQuestionLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="deleteQuestionLabel">Are you Sure you want to Delete?</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="deleteForm" action="./php/deleteQuestion.php" method="POST">
                        <input type="text" name="id" id="id" hidden>
                        <input type="text" name="code" id="code" hidden>
                        <div class="modal-footer" style='border: none;'>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Close</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="cont">
        <div id="tableCont">
            <div class="d-flex justify-content-between">
                <h2><a href='quiz_code.php' class="fa-solid fa-arrow-left-long"></a> Questions of <strong><?php echo $code ?></strong></h2>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addQuestion">
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
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "../php/config.php";
                    $sql = mysqli_query($conn, "SELECT * FROM questions where quiz_code = '$code'");
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
                                <td>
                                    <i data-toggle='modal' data-target='#addQuestion' data-id='{$data['question_id']}' data-code='{$data['quiz_code']}' data-question='{$data['question']}' data-option1='{$data['option1']}' data-option2='{$data['option2']}' data-option3='{$data['option3']}' data-option4='{$data['option4']}' data-correct ='{$data['correct']}' class='fa-regular fa-edit font-weight-bold mr-2 editIcon text-primary'></i>
                                    <i data-toggle='modal' data-target='#deleteQuestion' data-id='{$data['question_id']}' data-code='{$data['quiz_code']}' class='fa-regular fa-trash font-weight-bold mr-2 deleteIcon text-primary'></i>
                                </td>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/questions.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>

</html>