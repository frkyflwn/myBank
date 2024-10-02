<?php

session_start();

include("connection.php");
include("functions.php");
include("login-validation.php");

?>


<!DOCTYPE html>
<html>
<head>
    <title>myBank Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>myBank</h1>
<div id="box">

    <form method="post">
        <div style="font-size: 20px;margin: 10px;">Login</div>
        <p>Bitte geben Sie Ihre myBank Zugangsdaten ein:</p>

        <input id="text" type="text" name="user_name"><br><br>
        <input id="text" type="password" name="password"><br><br>

        <input id="button" type="submit" value="Login"><br><br>

        <a href="signup.php">Noch kein Konto? Registrieren</a><br><br>
        <a href="adminlogin.php">zum Mitarbeiter Login</a>
    </form>
</div>
</body>
</html>