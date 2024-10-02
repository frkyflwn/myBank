<?php

session_start();

include("worker_connection.php");
include("admin_connection.php");
include("adminfunctions.php");
include("admin_login_validation.php");

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
        <div style="font-size: 20px;margin: 10px;">Mitarbeiter Login</div>
        <p>Bitte geben Sie Ihre myBank Zugangsdaten ein:</p>

        <input id="text" type="text" name="user_name"><br><br>
        <input id="text" type="password" name="password"><br><br>

        <input id="button" type="submit" value="Login"><br><br>

        <a href="index.php">zum User Login</a></a><br><br>

    </form>
</div>
</body>
</html>