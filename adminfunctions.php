<?php

// Account Bestätigung, "status" auf "activated" updaten

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Überprüfen, ob der Bestätigen-Button geklickt wurde
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'confirm_button_') !== false) {
            $user_id = str_replace('confirm_button_', '', $key);

            // Aktualisiere den Status des Benutzers auf "activated"
            $update_query = "UPDATE users SET status = 'activated' WHERE id = '$user_id'";
            $update_result = mysqli_query($workercon, $update_query);

            if ($update_result) {
                // Weiterleitung zur worker.php-Seite
                header("Location: worker.php");
                exit();
            } else {
                echo "Fehler beim Aktualisieren des Benutzerstatus.";
            }
        }
    }
}

// Login Überprüfung und Rückgabe der Nutzerdaten

function check_login($con)
{
    if (isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
        $query = "SELECT users.*, accounts.*
                FROM users 
                INNER JOIN accounts ON users.id = accounts.accounts_id 
                WHERE users.id = '$id' 
                LIMIT 1";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }

    // Redirect zum Admin Login bei Fehler
    header("Location: adminlogin.php");
    die;
}

// Nutzerdaten ändern Formular

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['selected_user'])) {
        $selected_user = $_POST['selected_user'];

        // Nutzerdaten abfragen
        $selected_user_query = "SELECT users.*, accounts.*
        FROM users 
        INNER JOIN accounts ON users.id = accounts.accounts_id
        WHERE users.id = '$selected_user'
        LIMIT 1";

        $result = mysqli_query($admincon, $selected_user_query);

        if ($result) {
            $selected_user_data_new = mysqli_fetch_assoc($result);
        } else {
            echo "Nutzer konnten nicht geladen werden";
        }
    } elseif (isset($_POST['form_identifier']) && $_POST['form_identifier'] === 'form3') {

        // Formular wurde abgeschickt, Daten aus Felder laden

        $selected_user_id = $_POST['id'];
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $street_name = $_POST['street_name'];
        $street_number = $_POST['street_number'];
        $postal_code = $_POST['postal_code'];
        $city = $_POST['city'];
        $account_number = $_POST['account_number'];
        $balance = $_POST['balance'];
        $role = $_POST['role'];
        $status = $_POST['status'];

        // Benutzerdaten aktualisieren in der Datenbank

        $update_user_query = "UPDATE users
        SET user_name = '$user_name',
            password = '$password',
            first_name = '$first_name',
            last_name = '$last_name',
            street_name = '$street_name',
            street_number = '$street_number',
            postal_code = '$postal_code',
            city = '$city',
            role = '$role',
            status = '$status'
        WHERE id = '$selected_user_id'";

        $update_account_query = "UPDATE accounts
        SET account_number = '$account_number',
            balance = '$balance'
        WHERE accounts_id = '$selected_user_id'";

        $update_result = mysqli_query($admincon, $update_user_query);
        $update_account_result = mysqli_query($admincon, $update_account_query);

        if ($update_result && $update_account_result) {

            // Erfolgreiche Aktualisierung der Daten

            header("Location: successadmin.php");
        } else {

            // Fehler beim Aktualisieren

            echo "Fehler beim Aktualisieren der Daten.";
        }
    }
}