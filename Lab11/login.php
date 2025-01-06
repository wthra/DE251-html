<?php
require_once 'config.php';

// Start session
session_start();

// If already logged in, redirect to appropriate page
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: " . ($_SESSION['role'] === 'admin' ? 'admin.php' : 'user.php'));
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = initDB();

    $username = sanitize($_POST['user']);
    $password = $_POST['pass'];

    $stmt = $conn->prepare("SELECT username, password, role FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if ($password === $row['password']) { // In production, use password_verify()
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $row['role'];

            header("Location: " . ($row['role'] === 'admin' ? 'admin.php' : 'user.php'));
            exit;
        }
    }

    $error_message = "Invalid username or password";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .error-message {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <form method="post" class="login-form">
        <h2>Login</h2>
        <?php if (isset($error_message)): ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <div class="form-group">
            <label>Username:</label>
            <input type="text" name="user" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Password:</label>
            <input type="password" name="pass" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
</body>
</html>