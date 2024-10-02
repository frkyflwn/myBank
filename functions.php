<?php

include("connection.php");

// Login Daten Überprüfung und Rückgabe der Nutzerdaten

function check_login($con)
{
    if (isset($_SESSION['id']))
    {
        $id = $_SESSION['id'];
        $query = "SELECT users.*, accounts.*
                  FROM users 
                  INNER JOIN accounts ON users.id = accounts.accounts_id 
                  WHERE users.id = '$id' 
                  LIMIT 1";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0)
        {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }

    // Redirect zum User Login
    header("Location: index.php");
    die;
}

// Zufällige Kontonummer generieren

function random_num($length)
{
    $text = "";

    for ($i = 0; $i < $length; $i++) {
        $text .= rand(0, 9);
    }

    return $text;
}

// Überprüfung ob Kontonummer in DB existiert

function checkExistingAccountNumber($account_number, $con)
{
    $query1 = "SELECT COUNT(*) as count FROM accounts WHERE account_number = '$account_number'";
    $result1 = mysqli_query($con, $query1);

    if ($result1) {
        $row = mysqli_fetch_assoc($result1);
        $count = $row['count'];
        if ($count > 0) {
            return true; // Die Kontonummer existiert bereits in der Datenbank
        }
    }

    return false; // Die Kontonummer ist nicht in der Datenbank vorhanden
}

// Kontonummer-Generierung bis eine erstellt wurde die noch nicht in DB existiert

function generateUniqueAccountNumber($length, $con)
{
    $account_number = random_num($length);

    while (checkExistingAccountNumber($account_number, $con)) {
        $account_number = random_num($length); // Generiere eine neue Kontonummer
    }

    return $account_number;
}


// Einzahlungsmethoden


function einzahlung($con, $betrag)
{
    // Überprüfe, ob der Benutzer eingeloggt ist
    if (isset($_SESSION['id']))
    {
        $id = $_SESSION['id'];
        $user_data = check_login($con);
        $account_number = $user_data['account_number'];

        // Betrag zur Balance hinzufügen
        $query = "UPDATE accounts SET balance = balance + $betrag WHERE accounts_id = '$id'";
        $result = mysqli_query($con, $query);

        if ($result)
        {
            // Kontoauszug erstellen
            $statementQuery = "INSERT INTO statements (account_number, receiver_id, transaction_type, amount) 
                                   VALUES ($account_number, $account_number, 'Einzahlung', $betrag) ";
            $statementResult = mysqli_query($con, $statementQuery);

            if ($statementResult)
            {
                // Erfolgreich eingezahlt
                return true;
            }
            else
            {
                // Fehler beim Erstellen des Kontoauszugs
                echo "Fehler erste methode";
                return false;
            }
        }
        else
        {
            // Fehler bei der Aktualisierung des Kontostands
            return false;
        }
    }

    // Benutzer nicht eingeloggt - Weiterleitung zum Login
    header("Location: index.php");
    die;
}


// Wenn auf einzahlen Button geklickt wird

if (isset($_POST['einzahlen']))
{
    $betrag = $_POST['betrag'];
    $einzahlung_erfolgreich = einzahlung($con, $betrag);


    if ($einzahlung_erfolgreich)
    {

        // Erfolgreich eingezahlt
        header("Location: success.php?event=deposit");

    }
    else
    {
        // Fehler bei der Einzahlung
        echo "Fehler bei der Einzahlung2.";
    }
}

// Auszahlungsmethoden

function auszahlung($con, $betrag)
{
    // Überprüfe, ob der Benutzer eingeloggt ist
    if (isset($_SESSION['id']))
    {
        $id = $_SESSION['id'];
        $user_data = check_login($con);
        $account_number = $user_data['account_number'];

        // Kontostand abrufen
        $query = "SELECT balance FROM accounts WHERE accounts_id = '$id'";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0)
        {
            $row = mysqli_fetch_assoc($result);
            $balance = $row['balance'];

            // Prüfen, ob genügend Guthaben vorhanden ist
            if ($balance >= $betrag)
            {
                // Auszahlung durchführen
                $updated_balance = $balance - $betrag;
                $update_query = "UPDATE accounts SET balance = $updated_balance WHERE accounts_id = '$id'";
                $update_result = mysqli_query($con, $update_query);

                if ($update_result)
                {
                    // Kontoauszug erstellen
                    $statementQuery = "INSERT INTO statements (account_number, receiver_id, transaction_type, amount) 
                                       VALUES ('-', $account_number, 'Auszahlung', $betrag) ";
                    $statementResult = mysqli_query($con, $statementQuery);

                    if ($statementResult)
                    {
                        // Erfolgreich eingezahlt
                        return true;
                    }
                    else
                    {
                        // Fehler beim Erstellen des Kontoauszugs
                        echo "Fehler erste methode";
                        return false;
                    }
                }
                else
                {
                    // Fehler bei der Aktualisierung des Kontostands
                    return false;
                }
            }
            else
            {
                // Nicht genügend Guthaben für Auszahlung
                return false;
            }
        }
    }

    // Benutzer nicht eingeloggt - Weiterleitung zum Login
    header("Location: index.php");
    die;
}

// Wenn auf auszahlen Button geklickt wird

if (isset($_POST['auszahlen']))
{
    $betrag = $_POST['betrag'];
    $auszahlung_erfolgreich = auszahlung($con, $betrag);

    if ($auszahlung_erfolgreich)
    {
        // Erfolgreich ausgezahlt
        header("Location: success.php?event=withdrawal");
    }
    else
    {
        // Fehler bei der Auszahlung
        echo "Fehler bei der Auszahlung.";

    }
}

// Adresse und Passwort ändern Formulare

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['form_identifier'])) {
        $form_identifier = $_POST['form_identifier'];
        $user_data = check_login($con);
        $id = $_SESSION['id'];

        // Überprüfen ob Adresse oder Passwort Formular abgesendet wird

        if ($form_identifier == "form1") {
            processForm1($con);
        } elseif ($form_identifier == "form2") {
            processForm2($con);
        }

    }
}

function processForm1($con) {

    // Überprüfe, ob der Benutzer eingeloggt ist
    if (isset($_SESSION['id'])) {

        $user_data = check_login($con);
        $id = $_SESSION['id'];

        // Persönliche Daten
        $street_name = $_POST['street_name'];
        $street_number = $_POST['street_number'];
        $city = $_POST['city'];
        $postal_code = $_POST['postal_code'];

        if (!empty($street_name) && !empty($street_number) && !empty($city) && !empty($postal_code)) {
            // Update neue Daten
            $sql = "UPDATE users SET
                    street_name = '$street_name',
                    street_number = '$street_number',
                    city = '$city',
                    postal_code = '$postal_code'
                    WHERE id = '$id'";

            mysqli_query($con, $sql);


            header("Location: success.php?event=adresschange");
            die;
        }
        echo "Bitte geben Sie gültige Daten ein!";
    }
}


function processForm2($con) {

    // Überprüfe, ob der Benutzer eingeloggt ist
    if (isset($_SESSION['id'])) {

        $user_data = check_login($con);
        $id = $_SESSION['id'];

        // Login Daten
        $currentpassword = $user_data['password'];
        $oldpassword = $_POST['old_password'];
        $newpassword = $_POST['new_password'];
        $confirmpassword = $_POST['confirm_new_password'];

        if (!empty($newpassword) && ($newpassword === $confirmpassword) && ($oldpassword === $currentpassword)) {
            // Update neue Daten
            $sql = "UPDATE users SET
                    password = '$newpassword'
                    WHERE id = '$id'";

            mysqli_query($con, $sql);

            header("Location: success.php?event=passwordchange");
            die;
        }

        echo "Bitte geben Sie gültige Daten ein!";
    }
}


// Überweisungen

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['form_identifier'])) {
        $form_identifier = $_POST['form_identifier'];
        $user_data = check_login($con);
        $id = $_SESSION['id'];


        if ($form_identifier == "form3") {
            processTransferForm($con);
        } else {
            echo "Formular nicht gefunden";
        }

    }
}

function processTransferForm($con) {

    $user_data = check_login($con);

    $amount = $_POST['amount'];
    $receiver_name = $_POST['receiver_name'];
    $receiver_account_number = $_POST['receiver_account_number'];
    $purpose = $_POST['purpose'];

    // Check ob Account existiert
    $query = "SELECT * FROM accounts WHERE account_number = '$receiver_account_number'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        // Sender Daten
        $sender_account_number = $user_data['account_number'];
        $sender_query = "SELECT * FROM accounts WHERE account_number = '$sender_account_number'";
        $sender_result = mysqli_query($con, $sender_query);
        $sender_row = mysqli_fetch_assoc($sender_result);

        // Receiver Daten
        $receiver_row = mysqli_fetch_assoc($result);

        if ($sender_row['balance'] >= $amount) {
            // Update Sender Kontostand
            $sender_new_balance = $sender_row['balance'] - $amount;
            $sender_update_query = "UPDATE accounts SET balance = '$sender_new_balance' WHERE account_number = '$sender_account_number'";
            mysqli_query($con, $sender_update_query);

            // Update Receiver Kontostand
            $receiver_new_balance = $receiver_row['balance'] + $amount;
            $receiver_update_query = "UPDATE accounts SET balance = '$receiver_new_balance' WHERE account_number = '$receiver_account_number'";
            mysqli_query($con, $receiver_update_query);

            // Kontoauszug erstellen
            $insert_query = "INSERT INTO statements (account_number, receiver_id, transaction_type, amount, transaction_date) VALUES ('$sender_account_number', '$receiver_account_number', '$purpose', '$amount', NOW())";
            mysqli_query($con, $insert_query);

            header("Location: success.php?event=transfer");

        } else {
            echo "Nicht genug Guthaben";
        }
    } else {
        echo "Empfänger Account nicht gefunden";
    }
}
