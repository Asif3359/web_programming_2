<?php
include_once "./db.php";

if (isset($_POST['signup'])) {

    $userName = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($userName) || empty($email) || empty($password)) {
        header("Location: signup.php?error=signup_empty");
        exit();
    }

    $check = $conn->prepare("SELECT id FROM user WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        header("Location: signup.php?error=email_exists");
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $role = "student";

    $stmt = $conn->prepare(
        "INSERT INTO user (username, email, password, role)
         VALUES (?, ?, ?, ?)"
    );
    $stmt->bind_param("ssss", $userName, $email, $hashedPassword, $role);

    if ($stmt->execute()) {
        header("Location: signup.php?signup=success");
        exit();
    } else {
        header("Location: signup.php?error=signup_failed");
        exit();
    }
}


?>