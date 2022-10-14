<?php

include_once "config.php";
$name = mysqli_real_escape_string($conn, $_POST['name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

if (!empty($name) && !empty($email) && !empty($password)) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) { // if email is valid
        $sql =  mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}'");
        if (mysqli_num_rows($sql) > 0) {
            echo "$email - This email already existe!";
        } else {
            $random_id = rand(100000, 999999); // creating random id for the user
            $sql2 = mysqli_query($conn, "INSERT INTO `users` (`unique_id`, `name`, `email`, `password`) VALUES ($random_id, '{$name}', '{$email}', '{$password}')");
            if ($sql2) {
                echo "success";
            }
        }
    } else {
        echo "$email - This is not a valid email";
    }
} else {
    echo "All the input fields are required!";
}
