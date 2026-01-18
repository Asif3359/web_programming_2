<?php
include_once "./db.php";


if (isset($_POST['login'])) {

    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        header("Location: login.php?error=login_empty");
        exit();
    }

    // fetch user by email
    $stmt = $conn->prepare(
        "SELECT id, username, password, role 
         FROM user 
         WHERE email = ?"
    );
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // email not found
    if ($result->num_rows === 0) {
        header("Location: login.php?error=email_not_exists");
        exit();
    }

    $user = $result->fetch_assoc();

    // verify password
    if (!password_verify($password, $user['password'])) {
        header("Location: login.php?error=wrong_password");
        exit();
    }

    // login success → set session
    $_SESSION['user_id']  = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role']     = $user['role'];

    header("Location: dashboard.php");
    exit();
}


?>