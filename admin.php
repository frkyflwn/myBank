<?php
session_start();

if ($_SESSION['role'] !== 'admin') {
    // Redirect to an unauthorized page or display an error message
    header("Location: unauthorized.php");
    exit();
}

include("admin_connection.php");
include("adminfunctions.php");

$user_data = check_login($admincon);

?>

<!DOCTYPE html>
<html>
<head>
    <title>myBank Admin Portal</title>
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
    <h2 id="navheadline">Admin Portal</h2>
    <hr>

    <div id="navmenu">
        <ul>
            <li><button onclick="loadContent('userlist_admin.php')">Nutzer Übersicht</button></li>
            <li><button onclick="loadContent('statementslist.php')">Kontoauszüge</button></li>
        </ul>
    </div>

</div>

<div id="adminbox">
    <div id="content">
        <h2>Aktion im Menü auswählen</h2>
    </div>
</div>

</body>
</html>