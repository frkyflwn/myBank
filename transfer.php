<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);

?>

<form method="post">
    <input type="hidden" name="form_identifier" value="form3">

    <h3>Name des Empfängers</h3>
    <input type="text" name="receiver_name" class="textbox" required>

    <h3>Kontonummer</h3>
    <input maxlength="9" name="receiver_account_number" class="textbox" required>

    <h3>Betrag</h3>
    <input type="number" min="0.01" step="0.01" pattern="\d+(\.\d{1,2})?" name="amount" class="no-arrows" required>

    <h3>Verwendungszweck</h3>
    <input maxlength="20" type="text" name="purpose" class="textbox" required>
    <br>
    <button type="submit" class="button">Überweisung Bestätigen</button>

</form>



<div class="transfer">

</div>


