<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
    header("Location: login.php");
}
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
        <div class="quiz-container p-4" id="quiz">
            <div id="error-txt"></div>
            <div id="success-txt"></div>
            <div id="quiz-header">

            </div>

            <button id="quizBtn">Submit</button>

        </div>
    </div>


    <!-- <script src="js/quiz.js"></script> -->

    <script>
        const quiz = document.getElementById('quiz'),
            questionCont = document.getElementById('quiz-header'),
            questionEl = document.getElementById('question'),
            a_text = document.getElementById('a_text'),
            b_text = document.getElementById('b_text'),
            c_text = document.getElementById('c_text'),
            d_text = document.getElementById('d_text'),
            quizBtn = document.getElementById('quizBtn'),
            errorText = document.getElementById("error-txt"),
            successText = document.getElementById("success-txt");
        var code = "<?php echo $_GET['code'] ?>";
        var quid = 0;
        let questionCount = 0;
        let resultCount = 0;
        getQuestion();

        function getSelected() {
            var ans = document.getElementsByName('answer');
            var answer;
            for (var i = 0; i < ans.length; i++) {
                if (ans[i].checked) {
                    answer = ans[i].value;
                }
            }
            return answer;
        }

        quizBtn.onclick = () => {
            let answer = getSelected();
            let xhr = new XMLHttpRequest();
            xhr.open("GET", "php/checkResult.php?q=" + quid + "&code=" + code + "&r=" + answer, true);
            xhr.onload = () => {
                if (xhr.readyState == XMLHttpRequest.DONE) {
                    if (xhr.status == 200) {
                        var data = xhr.response;
                        if (data == 'correct') {
                            successText.innerText = 'Your answer is correct😊';
                            successText.style.display = 'block';
                            errorText.style.display = 'none';
                            resultCount++;
                            setTimeout(() => {
                                getQuestion();
                                successText.style.display = 'none';
                                errorText.style.display = 'none';
                            }, 1000);
                        } else if (data == 'incorrect') {
                            errorText.innerText = 'Your answer is incorrect☹️';
                            successText.style.display = 'none';
                            errorText.style.display = 'block';
                            setTimeout(() => {
                                getQuestion();
                                successText.style.display = 'none';
                                errorText.style.display = 'none';
                            }, 1000);
                        } else if ('not selected') {
                            errorText.innerText = 'Please select any answer🙄';
                            successText.style.display = 'none';
                            errorText.style.display = 'block';
                            setTimeout(() => {
                                successText.style.display = 'none';
                                errorText.style.display = 'none';
                            }, 1000);
                        }
                    }
                }
            }
            xhr.send();
        }

        function getQuestion() {
            quid++;

            let xhr = new XMLHttpRequest(); // creating xml object
            xhr.open("GET", "php/getQuestion.php?q=" + quid + "&code=" + code, true);
            xhr.onload = () => {
                if (xhr.readyState == XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var data = JSON.parse(xhr.responseText);
                        // result[0] num of rows in a table
                        // result[1] other output by echo
                        if (data["question"] == 'no question') {
                            if (questionCount == data["row"] /*total question */ ) {
                                quiz.innerHTML = `
                                    <h2>You answered ${resultCount}/${questionCount} questions correctly</h2>
                                <div class="d-flex">
                                    <button onclick="location.href='selectQuiz.php';">Give Another Quiz</button>
                                    <button onclick="location.href='score.php';">Go in Score</button>
                                </div>`;
                                let xhr = new XMLHttpRequest();
                                xhr.open("GET", "php/addResult.php?code=" + code + "&correct=" + resultCount + "&wrong=" + (questionCount - resultCount), true);
                                xhr.onload = () => {
                                    if (xhr.readyState == XMLHttpRequest.DONE) {
                                        if (xhr.status == 200) {
                                            var data = xhr.response;
                                        }
                                    }
                                }
                                xhr.send();
                            } else {
                                getQuestion();
                            }
                        } else {
                            questionCount++;
                            questionCont.innerHTML = `
                            <h2 id="question">${data["question"][0]}</h2>
                            <ul>
                            <li>
                                <input type="radio" name="answer" value="${data["question"][1]}" id="a" class="answer">
                                <label for="a" id="a_text">${data["question"][1]}</label>
                            </li>
                            <li>
                                <input type="radio" name="answer" value="${data["question"][2]}" id="b" class="answer">
                                <label for="b" id="b_text">${data["question"][2]}</label>
                            </li>
                            <li>
                            <input type="radio" name="answer" value="${data["question"][3]}" id="c" class="answer">
                            <label for="c" id="c_text">${data["question"][3]}</label>
                            </li>
                            <li>
                            <input type="radio" name="answer" value="${data["question"][4]}" id="d" class="answer">
                            <label for="d" id="d_text">${data["question"][4]}</label>
                            </li>
                            </ul>`;
                        }
                    }
                }
            }
            xhr.send();
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>

</html>