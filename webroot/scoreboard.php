<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];
?>

<!doctype html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Score Board</title>
    <link rel="stylesheet" href="css/scoreboard.css">
    <style>
        table {
            border-collapse: collapse;
            width: 60%;
            margin: 20px auto;
        }
        th, td {
            padding: 10px;
            border: 1px solid #999;
            text-align: center;
        }
        h1, p {
            text-align: center;
        }
        .logout {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<h1><?= htmlspecialchars($user['fullname']) ?></h1>
<p>Student ID: <?= htmlspecialchars($user['student_id']) ?></p>

<table>
    <tr>
        <th>Exam</th>
        <th>Score</th>
    </tr>
    <?php for ($i = 1; $i <= 10; $i++): ?>
        <tr>
            <td>Exam <?= $i ?></td>
            <td><?= htmlspecialchars($user["exam$i"]) ?></td>
        </tr>
    <?php endfor; ?>
    <tr>
        <th>Sum</th>
        <th><?= htmlspecialchars($user['sum']) ?></th>
    </tr>
</table>

<div class="logout">
    <a href="logout.php">Log out</a>
</div>

</body>
</html>
