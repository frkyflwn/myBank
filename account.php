<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);

?>

<div class="account">

    <h2>Ihre Anschrift</h2>
    <h3><?php
        echo $user_data['first_name'] . ' ' . $user_data['last_name'] . '<br>';
        echo $user_data['street_name'] . ' ' . $user_data['street_number'] . '<br>';
        echo $user_data['postal_code'] . ' ' . $user_data['city'];
        ?></h3>

    <button onclick="loadAdressForm()" class="button">Adresse ändern</button>
    <br>
    <button onclick="loadPasswordForm()" class="button">Passwort ändern</button>
    <br>

</div>

<form id="accountForm" method="post">
    <hr>

    <input type="hidden" name="form_identifier" value="form1">
    <h3>Name</h3>
    <input type="text" class="textbox" value="<?php echo $user_data['user_name']; ?>" readonly>

    <h3>Straße</h3>
    <input type="text" class="textbox" name="street_name" value="<?php echo $user_data['street_name']; ?>">

    <h3>Hausnummer</h3>
    <input type="text" class="textbox" name="street_number" value="<?php echo $user_data['street_number']; ?>">

    <h3>Postleitzahl</h3>
    <input type="text" class="textbox" name="postal_code" value="<?php echo $user_data['postal_code']; ?>">

    <h3>Stadt</h3>
    <input type="text" class="textbox" name="city" value="<?php echo $user_data['city']; ?>">
    <br>
    <button type="submit" class="button">Änderungen speichern</button>

</form>

<form id="accountForm2" method="post">
    <hr>
    <input type="hidden" name="form_identifier" value="form2">
    <h3>Altes Passwort</h3>
    <input type="password" name="old_password" class="textbox" required>

    <h3>Neues Passwort</h3>
    <input type="password" name="new_password" class="textbox" required>

    <h3>Neues Passwort bestätigen</h3>
    <input type="password" name="confirm_new_password" class="textbox" required>
    <br>
    <button type="submit" class="button">Änderungen speichern</button>

</form>

<br>
<h3>Account erstellt am:&nbsp;<?php echo $user_data['date']; ?></h3>
