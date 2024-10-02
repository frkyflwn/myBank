<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);

?>

<h2>Hallo <?php echo $user_data['user_name'] ?></h2>

<div class="overview">
    <h3>Giro Kontonummer:&nbsp;<?php echo $user_data['account_number']; ?></h3>
    <h2>Kontostand</h2>
    <h2><?php echo $user_data['balance']; ?>&nbsp;€</h2>

</div>