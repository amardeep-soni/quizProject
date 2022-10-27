<?php

include_once "config.php";
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

if (!empty($email) && !empty($password)) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) { // if email is valid
        $sql =  mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
        if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_assoc($sql);

            if ($row['password'] == $password) {
                echo "success";
                session_start();
                $_SESSION['unique_id'] = $row['unique_id'];
                $_SESSION['name'] = $row['name'];
            } else {
                echo "Password Invalid!";
            }
        } else {
            echo "You aren't signed up";
        }
    } else {
        echo "$email - This is not a valid email";
    }
} else {
    echo "All the input fields are required!";
}
