<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);
$errorMessage = "Fehler bei der Einzahlung.";

?>


<div class="depositwithdrawal">

    <div id="errorMessage"></div>

    <h3>Giro Kontonummer:&nbsp;<?php echo $user_data['account_number']; ?></h3>
    <h2>Kontostand</h2>
    <h2><?php echo $user_data['balance']; ?>&nbsp;€</h2>

    <form id="depositwithdrawalform" method="post" action="">
        <input type="number" min="0.01" step="0.01" pattern="\d+(\.\d{1,2})?" name="betrag" placeholder="Betrag eingeben" required><br>
        <button id="depositbutton" type="submit" name="einzahlen">einzahlen</button>
        <button type="submit" name="auszahlen">auszahlen</button>
    </form>
</div>