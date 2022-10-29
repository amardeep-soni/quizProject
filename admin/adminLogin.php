<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style.css">

</head>

<body>

    <div class="container">
        <div class="forms">
            <div class="form login">
                <span class="title">Login as admin</span>
                <form action="#" class="loginForm">
                    <div class="error-txt">This is an error message!</div>
                    <div class="success-txt">This is an success message!</div>
                    <div class="input-field">
                        <input type="text" name="username" placeholder="Enter your username" required>
                        <i class="fa-regular fa-user"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" name="password" class="password" placeholder="Enter your password" required>
                        <i class="fa-solid fa-lock"></i>
                    </div>

                    <div class="input-field button">
                        <input type="submit" value="Login">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="js/adminLogin.js"></script>
</body>

</html>