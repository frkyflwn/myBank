<?php
session_start();

if ($_SESSION['role'] !== 'sachbearbeiter') {
    // Redirect -> kein Zugang
    header("Location: unauthorized.php");
    exit();
}

include("worker_connection.php");
include("adminfunctions.php");

$user_data = check_login($workercon);
?>

<!DOCTYPE html>
<html>
<head>
    <title>myBank Mitarbeiter Portal</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="stylefunctions.js"></script>

</head>
<body>
<div id="box">
    <div class="header">
        <div class="logo">
            <h1>myBank</h1>
        </div>
        <div class="logout">
            <img class="usericon" src="imgs/usericon.png" alt="Icon">
            <p><?php echo $user_data['first_name'], " ", $user_data['last_name']; ?></p>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <br><br>
    <h2 id="navheadline">Mitarbeiter Portal</h2>
    <hr>

    <div id="navmenu">
        <ul>
            <li><button onclick="loadContent('userrequests.php')">Nutzer Anfragen</button></li>
            <li><button onclick="loadContent('userlist.php')">Nutzer Übersicht</button></li>
            <li><button onclick="loadContent('statementslist.php')">Kontoauszüge</button></li>
        </ul>
    </div>

    <div id="content">
        <h2>Aktion im Menü auswählen</h2>
    </div>

</body>
</html>