<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="lab3.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
    <title>Document</title>
</head>
<body>
<section class="vh-100" style="background-color: #eee;">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                                <?php

                                function dateCheck($date, $format = 'd/m/Y')
                                {
                                    $parts = date_parse_from_format($format, $date);
                                    return (checkdate($parts['month'], $parts['day'], $parts['year'])) ? true : false;
                                }

                                function dateConvert($date)
                                {
                                    return date("Y-m-d H:i:s", strtotime($date));
                                }

                                // define variables to empty values  
                                $loginErr = $login_error = $emailErr = $passErr = $repeatPassErr = $dateOfBirthErr = "";
                                $login = $email = $password = $repeatPass = $dateOfBirth = "";

                                //Input fields validation  
                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    //String Validation  
                                    if (empty($_POST["login"]) || strlen($_POST["login"]) < 4) {
                                        $loginErr = "*Login is to short or empty";
                                    } else {
                                        $login = $_POST["login"];
                                        // check if name only contains letters and whitespace  
                                        if (!preg_match("/[a-zа-яієїґ0-9]/i", $login)) {
                                            $loginErr = "*Login must contain only Latin and Cyrillic letters and numbers.";
                                        }
                                    }

                                    //Email Validation   
                                    if (empty($_POST["email"])) {
                                        $emailErr = "*Email is empty";
                                    } else {
                                        $email = $_POST["email"];
                                        // check that the e-mail address is well-formed  
                                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                            $emailErr = "*Invalid email format";
                                        }
                                    }


                                    if (empty($_POST["password"]) || strlen($_POST["password"]) < 7) {
                                        $passErr = "*Password is to short or empty";
                                    } else {
                                        $password = $_POST["password"];
                                        $numbers = preg_match('/[0-9]+/', $password);
                                        $uppercase = preg_match('/[A-Z]+/', $password);
                                        $lowercase = preg_match('/[a-z]+/', $password);
                                        if (!$numbers) {
                                            $passErr = '*Password must contains at least one number';
                                        } elseif (!$uppercase) {
                                            $passErr = '*Password must contains at least one uppercase letter';
                                        } elseif (!$lowercase) {
                                            $passErr = '*Password must contains at least one letter';
                                        }
                                    }

                                    if (empty($_POST["repeat-password"])) {
                                        $repeatPassErr = "*Password is empty";
                                    } else {
                                        $repeatPass = $_POST["repeat-password"];
                                        if ($_POST["repeat-password"] !== $_POST["password"]) {
                                            $repeatPassErr = "*Passwords are not equals";
                                        }
                                    }

                                    if (empty($_POST["date-of-birth"])) {
                                        $dateOfBirthErr = "*Date of birth is empty";
                                    } else {
                                        $dateOfBirth = $_POST["date-of-birth"];
                                        if (!dateCheck($dateOfBirth)) {
                                            $dateOfBirthErr = "*Invalid format";
                                        }
                                    }

                                    if ($loginErr == "" && $emailErr == "" && $passErr == "" && $repeatPassErr == "" && $dateOfBirthErr == "") {

                                        $login = $_POST["login"];
                                        $email = $_POST["email"];
                                        $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
                                        $dateOfBirth = dateConvert($_POST["date-of-birth"]);


                                        $query_add = "INSERT INTO `users` (`login`, `email`, `password`, `date_of_birth`) VALUES ('$login', '$email', '$password', '$dateOfBirth')";
                                        $query_get = "SELECT `login` FROM `users` WHERE `login` = '$login'";
                                        $connection = new mysqli("localhost", "root", "", "phpregform");

                                        $result = $connection->query($query_get);

                                        if ($result->num_rows == 0) {
                                            $connection->query($query_add);

                                            $connection->close();
                                        } else {
                                            $login_error = 'User with this login already exists.';
                                        }
                                    }
                                } ?>
                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>
                                <form class="mx-1 mx-md-4" action="" method="post">
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="form3Example1c">Login</label>
                                            <input id="form3Example1c" class="form-control" name="login" placeholder="Login" />
                                            <span class="text-danger text-center"><?php echo $loginErr; ?> </span>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="form3Example3c">Email</label>
                                            <input id="form3Example3c" class="form-control" name="email" placeholder="Email" />
                                            <span class="text-danger"><?php echo $emailErr; ?> </span>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="form3Example4c">Password</label>
                                            <input type="password" name="password" id="form3Example4c" class="form-control" placeholder="Password" />
                                            <span class="text-danger"><?php echo $passErr; ?> </span>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="form3Example4cd">Repeat Password</label>
                                            <input type="password" name="repeat-password" id="form3Example4cd" class="form-control" placeholder="Repeat Password" />
                                            <span class="text-danger"><?php echo $repeatPassErr; ?> </span>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="form3Example4cd">Date of Birth</label>
                                            <input name="date-of-birth" id="form3Example4cd" class="form-control" placeholder="dd-mm-yyyy" />
                                            <span class="text-danger"><?php echo $dateOfBirthErr; ?> </span>
                                        </div>
                                    </div>

                                    <div class="form-check d-flex justify-content-center mb-5">
                                        <span class="text-danger pl-5"><?php echo $login_error; ?> </span>
                                    </div>

                                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                        <input type="submit" class="btn submit-btn btn-lg">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>