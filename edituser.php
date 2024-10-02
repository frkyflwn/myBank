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
            <li><a href="admin.php"><button>zurück zur Übersicht</button></a></li>
        </ul>
    </div>
</div>

<div id="adminbox">
    <div id="content">
        <div class="edituserdiv">
            <h2>Daten ändern des Nutzers mit ID:</h2>
            <form id="userForm" method="post">
                <input type="hidden" name="form_identifier" value="form3">
                <h3>ID</h3>
                <input type="text" class="textbox" name="id" value="<?php echo $selected_user_data_new['id']; ?>" readonly>
                <h3>Login Name</h3>
                <input type="text" name="user_name" class="textbox" value="<?php echo $selected_user_data_new['user_name']; ?>">
                <h3>Passwort</h3>
                <input type="text" name="password" class="textbox" value="<?php echo $selected_user_data_new['password']; ?>">
                <h3>Vorname</h3>
                <input type="text" name="first_name" class="textbox" value="<?php echo $selected_user_data_new['first_name']; ?>">
                <h3>Nachname</h3>
                <input type="text" name="last_name" class="textbox" value="<?php echo $selected_user_data_new['last_name']; ?>">
                <h3>Straße</h3>
                <input type="text" name="street_name" class="textbox" value="<?php echo $selected_user_data_new['street_name']; ?>">
                <h3>Hausnummer</h3>
                <input type="text" name="street_number" class="textbox" value="<?php echo $selected_user_data_new['street_number']; ?>">
                <h3>Postleitzahl</h3>
                <input type="text" name="postal_code" class="textbox" value="<?php echo $selected_user_data_new['postal_code']; ?>">
                <h3>Stadt</h3>
                <input type="text" name="city" class="textbox" value="<?php echo $selected_user_data_new['city']; ?>">
                <h3>Kontonummer</h3>
                <input type="text" name="account_number" class="textbox" value="<?php echo $selected_user_data_new['account_number']; ?>">
                <h3>Kontostand</h3>
                <input type="text" name="balance" class="textbox" value="<?php echo $selected_user_data_new['balance']; ?>">
                <h3>Rolle</h3>
                <select name="role" class="textbox">
                    <?php
                    // zulässige ENUM-Werte für "role"
                    $allowed_roles = ["nutzer", "sachbearbeiter", "admin"];
                    foreach ($allowed_roles as $role) {
                        $selected = ($role === $selected_user_data_new['role']) ? "selected" : "";
                        echo "<option value=\"$role\" $selected>$role</option>";
                    }
                    ?>
                </select>
                <h3>Status</h3>
                <select name="status" class="textbox">
                    <?php
                    // zulässige ENUM-Werte für "status"
                    $allowed_status = ["activated", "deactivated"];
                    foreach ($allowed_status as $status) {
                        $selected = ($status === $selected_user_data_new['status']) ? "selected" : "";
                        echo "<option value='$status' $selected>$status</option>";
                    }
                    ?>
                </select>
                <br>
                <button type="submit" class="button">Änderungen speichern</button>
            </form>
        </div>
    </div>
</div>
<br>
<br>
</body>
</html>
