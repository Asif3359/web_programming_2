<?php
include_once "./db.php";
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}
include "./utils/signup.php";


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
    // success messages
    if (isset($_GET['signup']) && $_GET['signup'] === 'success') {
        echo "<p style='color:green'>Signup successful! You can login now.</p>";
    }
    // error messages
    if (isset($_GET['error'])) {
        $errors = [
            // signup
            'signup_empty'   => 'All signup fields are required.',
            'email_exists'   => 'This email is already registered.',
            'signup_failed'  => 'Signup failed. Please try again.',
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
        <h4>User signup </h4>
        <form  action="index.php" method="post" name="signup">
            <label class="levels" for="username">Username</label>
            <input class="inputs" type="text" name="username" id="username" required>

            <label class="levels" for="email">Email</label>
            <input class="inputs" type="email" name="email" id="email" required>

            <label class="levels" for="password">Password</label>
            <input class="inputs" type="password" name="password" id="password" required>

            <button class="buttons" type="submit" name="signup">Signup</button>

        </form>
    </div>
    <div><a class="buttons" href="./login.php">Login</a></div>
</body>

</html>