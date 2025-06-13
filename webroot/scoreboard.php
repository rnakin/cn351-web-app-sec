<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

//This following section detecting session timeout
//check if session timeout is set and more than 0 == timeout is set
// if there is a timeout set; there is a timeout and  is greater or equal to 0. :
    // if the last activity is set and the timeout has expired :
        // clear session data
        // kill the session
        // kick out to login
        // terminate the current php scripts 
//else if the time out is set and not expired :
    // update last activity 
    //good to go
//else (the time out is not set)
// 
//                                                                      :rnakin

if(isset($_SESSION['TIMEOUT']) && ($_SESSION['TIMEOUT']>=0)){  
    if(isset($_SESSION['LAST_ACTIVITY'])&& (time() - $_SESSION['LAST_ACTIVITY'])>$_SESSION['TIMEOUT']){   
        session_unset();                                                                
        session_destroy();                                                              
        header('Location:login.php')  ;                                                  
        exit();                                                               
    }else{                                                                              
        $_SESSION['LAST_ACTIVITY'] = time();   //update last activity
        session_regenerate_id(true);           //regenerate session id 
    }                                                                                               
}else if(isset($_SESSION['TIMEOUT'])&&($_SESSION['TIMEOUT']<=0)){       // not check "Keep me loged in"                                       
    session_unset();                                                                
    session_destroy();
    exit();
}else{
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
        .password {
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
<!-- <div class="password">
    <a href="change_password.php">Change your password</a>
</div> -->
<div class="logout">
    <a href="logout.php">Log out</a>
</div>

</body>
</html>
