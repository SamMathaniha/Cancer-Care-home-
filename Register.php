<?php

// Including the 'config.php' file
@include 'config.php';

// Starting the session
session_start();

// Checking if the form is submitted
if (isset($_POST['submit'])) {

    // Sanitizing and escaping the form inputs
    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
    $nic = mysqli_real_escape_string($conn, $_POST['nic']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']); // Encrypting the password using md5
    $usertype = 'Client'; // Automatically setting usertype to 'Client'

    // Query to check if the email already exists in the 'user' table
    $select = "SELECT * FROM user WHERE email = '$email'";

    $result = mysqli_query($conn, $select);

    // If the email already exists
    if (mysqli_num_rows($result) > 0) {
        $error[] = '!!! Email Already Registered !!!';
    } else {
        // Inserting the new user into the 'user' table
        $insert = "INSERT INTO user (FirstName, LastName, NIC, Email, Password, usertype) VALUES ('$firstName', '$lastName', '$nic', '$email', '$password', '$usertype')";
        mysqli_query($conn, $insert);

        // Redirecting the user to the login page after successful registration
        header('location:login.php');
    }
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Now</title>

    <!-- Use the same CSS from the user login -->
    <link rel="stylesheet" href="path-to-user-login-css.css">
    <!-- fa fa icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        body {
            /* Background Styles */
            background-image: url(./img/team-1.jpg);
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            animation: movingBackground 20s infinite linear;
        }

        /* Keyframes for Background Animation */
        @keyframes movingBackground {
            0% {
                background-position: 0% 100%;
            }

            50% {
                background-position: 100% 0%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        /* Container Styles */
        .container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        /* Form Styles */
        .container .form {
            background: rgba(255, 255, 255, 0.71);
            padding: 30px 35px;
            border-radius: 10px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        /* Form Control Styles */
        .container .form-control {
            height: 50px;
            width: 95%;
            display: flex;
            position: relative;
            font-size: 18px;
            margin-top: 20px;
            border-radius: 15px;
            border: 2px solid #393939;
            padding-left: 15px;
        }

        /* Button Styles */
        .container .form form .button {
            height: 50px;
            font-size: 20px;
            font-weight: bold;
            transition: all 0.3s ease;
            text-align: center;
            width: 100%;
            display: inline-block;
            margin-top: 15px;
        }

        /* Button Hover Styles */
        .container .form form .button:hover {
            background: #03ff1cbd;
        }

        /* Alert Styles */
        .container .row .alert {
            color: red;
            text-align: 10px;
            margin-top: 16px;
        }

        /* Center Text Styles */
        .text-center {
            text-align: center;
            font-size: 18px;
        }

        /* Center Text Styles */
        .text-center-head {
            text-align: center;
            font-size: 30px;
        }

        /* Home Icon Styles */
        .homeIcon {
            margin-top: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .signup-link {
            margin-top: 10px;
            text-align: center;
            font-size: 15px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 form login-form">
                <form action="#" method="POST">

                    <?php
                    if (isset($error)) {
                        foreach ($error as $error) {
                            echo '<div class="alert alert-danger text-center">' . $error . '</div>';
                        };
                    };
                    ?>

                    <h2 class="text-center-head">Register</h2>

                    <div class="form-group">
                        <input required="" type="text" name="firstName" class="form-control" placeholder="Enter Your First Name">
                    </div>

                    <div class="form-group">
                        <input required="" type="text" name="lastName" class="form-control" placeholder="Enter Your Last Name">
                    </div>

                    <div class="form-group">
                        <input required="" type="text" name="nic" class="form-control" placeholder="Enter Your NIC">
                    </div>

                    <div class="form-group">
                        <input required="" type="email" name="email" class="form-control" placeholder="Enter Your Email">
                    </div>

                    <div class="form-group">
                        <input required="" type="password" name="password" class="form-control" placeholder="Enter Your Password">
                    </div>

                    <div class="form-group">
                        <input class="form-control button" type="submit" name="submit" value="Register">
                    </div>

                    <div class="signup-link">Already have an account? <a href="login.php">Login here</a></div>

                    <div class="homeIcon">
                        <a href="./index.html"><i class="fa fa-home" style="font-size: 36px"></i></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>