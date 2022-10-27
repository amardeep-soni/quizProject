<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
    header("Location: login.php");
}
$unique_id = $_SESSION['unique_id'];
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
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto nav-pills">
                <li class="nav-item active">
                    <a class="nav-link" href="quiz.php">Home</a>
                </li>
            </ul>
            <div class="navbar-text">
                <a href="php/logout.php">Logout</a>
            </div>
        </div>
    </nav>
    <div class="cont">
        <div class="quiz-container p-4">
            <div id="error-txt">This is an error message!</div>
            <h2>Select Chapter</h2>
            <div class="selectValue">
                <?php
                include_once "php/config.php";
                $output = array();
                $sql = mysqli_query($conn, "SELECT * FROM chapter");
                if ($sql) {
                    $rowNum = mysqli_num_rows($sql);
                    if ($rowNum) {
                        while ($row = mysqli_fetch_assoc($sql)) {
                            $chapterName = ucfirst($row['chapter_name']);
                            echo "<a class='chapter' onclick='checkQuestion(this.id)' id='{$row['chapter_name']}' >$chapterName</a>";
                            // quiz.php?chap={$row['chapter_name']}
                        }
                    } else {
                        echo "No any chapter";
                    }
                }
                ?>
            </div>
        </div>

    </div>
    <script>
        const errorText = document.getElementById("error-txt");

        function checkQuestion(e) {
            var chap = e;
            let xhr = new XMLHttpRequest();
            xhr.open("GET", "php/checkQuestion.php?chap=" + chap, true);
            xhr.onload = () => {
                if (xhr.readyState == XMLHttpRequest.DONE) {
                    if (xhr.status == 200) {
                        var data = xhr.response;
                        if (data == 'no question') {
                            errorText.innerText = 'NO Any Questions. In This Chapter!';
                            errorText.style.display = 'block';
                            setTimeout(() => {
                                errorText.style.display = 'none';
                            }, 1000);
                        } else {
                            console.log('Question Found');
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