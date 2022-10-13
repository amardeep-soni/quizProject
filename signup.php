<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">

</head>

<body>

    <div class="container">
        <div class="forms">
            <div class="form signup">
                <span class="title">Registration</span>
                <form action="#" class="signupForm">
                    <div class="error-txt">This is an error message!</div>
                    <div class="success-txt">This is an success message!</div>
                    <div class="input-field">
                        <input type="text" placeholder="Enter your name" required>
                        <i class="fa-regular fa-user"></i>
                    </div>
                    <div class="input-field">
                        <input type="text" placeholder="Enter your email" required>
                        <i class="fa-regular fa-envelope"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" class="password" placeholder="Create a password" required>
                        <i class="fa-solid fa-lock"></i>
                    </div>

                    <div class="input-field button">
                        <input type="button" value="Signup">
                    </div>
                </form>

                <div class="login-signup">
                    <span class="text">Already a member?
                        <a href="login.php" class="text login-link">Login Now</a>
                    </span>
                </div>
            </div>
        </div>
    </div>


</body>

</html>