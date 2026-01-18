<?php
include_once "./db.php";
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}
include "./utils/login.php";


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link rel="stylesheet" href="./styles.css">

</head>

<body>

    <?php
    // error messages
    if (isset($_GET['error'])) {

        $errors = [
            // login
            'login_empty'        => 'Email and password are required.',
            'email_not_exists'  => 'Email not registered.',
            'wrong_password'    => 'Incorrect password.',
        ];

        if (array_key_exists($_GET['error'], $errors)) {
            echo "<p style='color:red'>{$errors[$_GET['error']]}</p>";
        } else {
            echo "<p style='color:red'>Something went wrong.</p>";
        }
    }
    ?>

    <div><a class="buttons" href="./index.php">HOME</a></div>

    <div class="froms">
        <h4>User Login </h4>
        <form  action="index.php" method="post" name="login">

            <label class="levels" for="email">Email</label>
            <input class="inputs" type="email" name="email" id="email" required>

            <label class="levels" for="password">Password</label>
            <input class="inputs" type="password" name="password" id="password" required>

            <button class="buttons" type="submit" name="login">login</button>

        </form>
    </div>

    <div><a class="buttons" href="./signup.php">Signup</a></div>
</body>

</html>