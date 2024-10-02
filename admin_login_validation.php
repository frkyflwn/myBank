<?php

//Abfrage für Admin und Mitarbeiter Login

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Loginname und Passwortabfrage
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {

        // Read from database
        $query = "SELECT * FROM users WHERE user_name = '$user_name' LIMIT 1";
        $result = mysqli_query($workercon, $query);

        if ($result) {
            if ($result && mysqli_num_rows($result) > 0) {

                $user_data = mysqli_fetch_assoc($result);

                if ($user_data['password'] === $password) {

                    $_SESSION['id'] = $user_data['id'];
                    $_SESSION['role'] = $user_data['role'];

                    // Überprüfung der Rolle des Nutzers
                    if ($user_data['role'] === 'sachbearbeiter') {
                        check_login($workercon);
                        header("Location: worker.php");
                    } elseif ($user_data['role'] === 'admin') {
                        check_login($admincon);
                        header("Location: admin.php");
                    } else {
                        echo "Invalid role";
                    }

                    die;
                }
            }
        }

        echo "Name/Passwort falsch";

    } else {
        echo "Name/Passwort falsch";
    }
}