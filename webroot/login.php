<?php
session_start();
$link = require_once 'phpadmin.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['student_id'] ?? '';
    $pw = $_POST['student_pw'] ?? '';

    //set timeout
    $_SESSION['TIMEOUT'] = 0;
    if (isset($_POST['remember_me'])) {
        $_SESSION['TIMEOUT'] = 900; // 15 Minutes
    }

    $query = "SELECT * FROM score WHERE student_id = '$id' AND student_pw = '$pw'";
    $result = mysqli_query($link, $query);

    if ($user = mysqli_fetch_assoc($result)) {
        $_SESSION['user'] = $user;
        header("Location: scoreboard.php");
        exit();
    } else {
        $error = "Invalid student id or password";
    }
}
?>

<!doctype html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>TSE Check Score</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
<div class="form-container">
    <h1>TSE Score Board</h1>
    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <form method="POST" action="">
        <div class="form-row">
            <label for="student_id">Student ID</label>
            <input type="text" name="student_id" id="student_id" required>
        </div>

        <div class="form-row">
            <label for="student_pw">Password</label>
            <input type="password" name="student_pw" id="student_pw" required>
        </div>
        <div class="btn-group"> <!-- remember me button -->
            <input type="checkbox"  id="remember_me" name="remember_me" value="remember_me" >
            <label for="remember_me"class="checkbox" style="display: inline-block;"> Remember me</label>
        </div>
        <div class="btn-group">
            <button type="submit" class="btn-login">Log in</button>
        </div>
    </form>
</div>
</body>
</html>
