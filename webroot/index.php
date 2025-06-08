<?php
session_start();

if (isset($_SESSION['user'])) {
    header("Location: scoreboard.php");
} else {
    header("Location: login.php");
}
exit();
?>