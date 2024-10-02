<?php
session_start();

include("connection.php");
include("functions.php");


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Login Daten
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    // Persönliche Daten
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $street_name = $_POST['street_name'];
    $street_number = $_POST['street_number'];
    $city = $_POST['city'];
    $postal_code = $_POST['postal_code'];

    if (!empty($user_name) && !empty($password) && ($password === $confirmpassword) && !empty($first_name) && !empty($last_name) && !empty($street_name) && !empty($street_number) && !empty($city) && !empty($postal_code)) {

        $query = "INSERT INTO users (user_name, password, first_name, last_name, street_name, street_number, city, postal_code)
					  VALUES ('$user_name', '$password', '$first_name', '$last_name', '$street_name', '$street_number', '$city', '$postal_code')";

        mysqli_query($con, $query);

        // inserted user ID
        $inserted_user_id = mysqli_insert_id($con);

        // Generiere eine eindeutige Kontonummer
        $length = 9; // Länge der Kontonummer
        $account_number = generateUniqueAccountNumber($length, $con);
        echo $account_number;
        $balance = 0;

        $account_query = "INSERT INTO accounts (accounts_id, account_number, balance)
							  VALUES ('$inserted_user_id', '$account_number', '$balance')";

        mysqli_query($con, $account_query);

        header("Location: successregistration.php");
        die;
    } else {
        echo "Bitte geben Sie gültige Daten ein!";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>myBank - Konto eröffnen</title>
    <script src="stylefunctions.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>myBank</h1>
<div id="box">

    <h2>Konto eröffnen</h2>

    <form method="post">

        <div id="step1">

            <h3>Login Daten</h3>
            <input id="text" type="text" name="user_name" placeholder="Login Name" required>
            <br><br>
            <input id="text" type="password" name="password" placeholder="Passwort eingeben" required>
            <br><br>
            <input id="text" type="password" name="confirmpassword" placeholder="Passwort bestätigen" required>
            <br><br>
            <h3>Persönliche Daten</h3>
            <input type="text" name="first_name" id="text" placeholder="Vorname" required>
            <br><br>
            <input type="text" name="last_name" id="text" placeholder="Nachname" required>
            <br><br>
            <input type="text" name="street_name" id="text" placeholder="Straße" required>
            <br><br>
            <input type="text" name="street_number" id="text" placeholder="Hausnummer" required>
            <br><br>
            <input type="text" name="city" id="text" placeholder="Stadt" required>
            <br><br>
            <input type="number" name="postal_code" id="text" placeholder="Postleitzahl" required>
            <br><br>
            <input id="button" type="submit" value="registrieren"><br><br>
        </div>

    </form>

    <a href="index.php">zum Login</a><br><br>
</div>
</body>
</html>