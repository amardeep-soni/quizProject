<?php

include_once "../../php/config.php";
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

if (!empty($username) && !empty($password)) {
    if ($username == 'admin' && $password == 'admin') {
        echo "success";
        session_start();
        $_SESSION['admin'] = true;
    } else {
        echo "Invalid credintals";
    }
} else {
    echo "All the input fields are required!";
}
