<?php
mysqli_report(MYSQLI_REPORT_STRICT|MYSQLI_REPORT_ERROR);

$host = "mariadb";
$username = "db_user";
$password = "db_pw";
$dbname = "score_db";

try {
    return mysqli_connect($host, $username, $password, $dbname);
} catch (mysqli_sql_exception $e) {
    error_log($e);
    die("Could not connect to database.");
}