<?php
$conn = mysqli_connect("localhost", "root", "" , "quizApp");
if (!$conn) {
    echo "Database not connected". mysqli_connect_error();
}