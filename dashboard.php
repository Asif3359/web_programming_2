<?php
session_start();

// protect dashboard (no login → no access)
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>

<body>

    <h2>Dashboard</h2>

    <p><strong>User ID:</strong> <?php echo $_SESSION['user_id']; ?></p>
    <p><strong>Username:</strong> <?php echo htmlspecialchars($_SESSION['username']); ?></p>
    <p><strong>Role:</strong> <?php echo $_SESSION['role']; ?></p>

    <br>

    <a href="logout.php">Logout</a>

</body>

</html>