<?php
session_start();

if ($_SESSION['role'] !== 'nutzer') {
    // Redirect to an unauthorized page or display an error message
    header("Location: unauthorized.php");
    exit();
}

include("connection.php");
include("functions.php");

$user_data = check_login($con);

?>

<!DOCTYPE html>
<html>
<head>
    <title>myBank Portal</title>
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
            <a class="accountdata" onclick="loadContent('account.php')">Persönliche Daten</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <br><br>
    <h2 id="navheadline">Konto Übersicht</h2>
    <hr>

    <div id="navmenu">
        <ul>
            <li><button onclick="loadContent('overview.php')">Konto Übersicht</button></li>
            <li><button onclick="loadContent('depositwithdrawal.php')">Ein-/Auszahlung</button></li>
            <li><button onclick="loadContent('transfer.php')">Überweisung</button></li>
            <li><button onclick="loadContent('statements.php')">Kontoauszüge</button></li>
        </ul>
    </div>

    <div id="content">

        <?php echo $dbuser ?>

        <h2>Hallo, <?php echo $user_data['user_name'] ?></h2>

        <div class="overview">
            <h3>Giro Kontonummer:&nbsp;<?php echo $user_data['account_number']; ?></h3>
            <h2>Kontostand</h2>
            <h2><?php echo $user_data['balance']; ?>&nbsp;€</h2>
        </div>

    </div>

</div>

</body>
</html>