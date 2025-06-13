<?php
session_start();
$link = require_once 'phpadmin.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $new_pw = $_POST["new_password"] ?? '';
    $student_id = $_SESSION['user']['student_id'];

    $query = "UPDATE score SET student_pw = '$new_pw' WHERE student_id = '$student_id'";
    mysqli_query($link, $query);

    $message = "Password is changed";
}
?>

<!doctype html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Change password</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    
<div class="form-container">
    <a href="scoreboard.php">Go Back</a>
    <h1>Change password</h1>
    <form method="POST">
        <div class="form-row">
            <input name="new_password" placeholder="Enter new password" type="password">
        </div>
        
        <div class="btn-group">
            <button type="submit" class="btn-login">submit</button>
        </div>
        
        <?php if (isset($message)): ?>
            <p style="text-align:center; color: green;"><?= $message ?></p>
        <?php endif; ?>
        
    </form>
    
</div>
</body>
</html>