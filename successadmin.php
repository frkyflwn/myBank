<?php
session_start();

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
    <script>
        setTimeout(function() {
            window.location.href = "admin.php";
        }, 4000);
    </script>

</head>
<body>
<div id="box">
    <div class="header">
        <div class="logo">
            <h1>myBank</h1>
        </div>
    </div>

    <br><br>
    <h2 id="navheadline">Nutzerdaten Änderung</h2>
    <hr>

    <div id="content">

        <img class="checkmark" src="imgs/checkmark.png">
        <h2>Nutzerdaten wurden erfolgreich aktualisiert</h2>
        Automatische Weiterleitung in wenigen Sekunden...

    </div>

</div>

</body>
</html>