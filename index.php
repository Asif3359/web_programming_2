<?php
include_once "./db.php";

session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

include "./utils/login.php";
include "./utils/signup.php";

if (isset($_POST['migrate'])) {

    $sql_user = "CREATE TABLE IF NOT EXISTS user (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        role ENUM('student', 'teacher', 'admin') NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    $sql_student = "CREATE TABLE IF NOT EXISTS student (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        roll_no VARCHAR(20) NOT NULL UNIQUE,
        class VARCHAR(20),
        FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE
    )";

    $sql_teacher = "CREATE TABLE IF NOT EXISTS teacher (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        employee_id VARCHAR(20) NOT NULL UNIQUE,
        subject VARCHAR(50),
        FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE
    )";

    if (mysqli_query($conn, $sql_user) && mysqli_query($conn, $sql_student) && mysqli_query($conn, $sql_teacher)) {
        echo "Tables migrated successfully!";
        header("Location: index.php?migrate=success");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
        header("Location: index.php?error=migrate_failed");
        exit();
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab task</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <?php if ($conn) {
        echo "Database connected <br>";
    } ?>

    <?php

    if (isset($_GET['migrate']) && $_GET['migrate'] === 'success') {
        echo "<p style='color:green'>Database tables migrated successfully!</p>";
    }
    // error messages
    if (isset($_GET['error'])) {

        $errors = [
            // migrate
            'migrate_failed' => 'Table migration failed.'
        ];

        if (array_key_exists($_GET['error'], $errors)) {
            echo "<p style='color:red'>{$errors[$_GET['error']]}</p>";
        } else {
            echo "<p style='color:red'>Something went wrong.</p>";
        }
    }
    ?>

    <form class="froms" method="post">
        <button class="buttons" type="submit" name="migrate">Migrate tables</button>
    </form>

    

    <div>
        <a class="buttons" href="./signup.php">Signup</a>
        <a class="buttons" href="./login.php">Login</a>
    </div>


</body>

</html>