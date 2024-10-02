<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);
$bigheadline = "";
$smallheadline = "";

$event = $_GET['event'];

// Überschriften ändern für Aktion

if ($event === 'deposit') {
    $bigheadline = "Einzahlungsbestätigung";
    $smallheadline = "Einzahlung erfolgreich";
} elseif ($event === 'withdrawal') {
    $bigheadline = "Auszahlungsbestätigung";
    $smallheadline = "Auszahlung erfolgreich";
} elseif ($event === 'adresschange') {
    $bigheadline = "Persönliche Daten geändert";
    $smallheadline = "Adresse erfolgreich geändert";
} elseif ($event === 'passwordchange') {
    $bigheadline = "Persönliche Daten geändert";
    $smallheadline = "Passwort erfolgreich geändert";
} elseif ($event === 'transfer') {
    $bigheadline = "Überweisungsbestätigung";
    $smallheadline = "Ihre Überweisung war erfolgreich";
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>myBank Portal</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="stylefunctions.js"></script>
    <script>
        setTimeout(function() {
            window.location.href = "user.php";
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
    <h2 id="navheadline"><?php echo $bigheadline; ?></h2>
    <hr>

    <div id="content">

        <img class="checkmark" src="imgs/checkmark.png">
        <h2><?php echo $smallheadline; ?></h2>
        Automatische Weiterleitung in wenigen Sekunden...

    </div>

</div>

</body>
</html>