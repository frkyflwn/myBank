<?php
session_start();

include("adminfunctions.php");

if ($_SESSION['role'] == 'nutzer') {
    // Redirect -> kein Zugriff
    header("Location: unauthorized.php");
    exit();
} elseif ($_SESSION['role'] == 'admin') {
    include("admin_connection.php");
    $updated_con = $admincon;
} elseif ($_SESSION['role'] == 'sachbearbeiter') {
    include("worker_connection.php");
    $updated_con = $workercon;
}

$user_data = check_login($updated_con);


// Nutzerdaten abfragen
$user_query = "SELECT users.*, accounts.*
            FROM users 
            INNER JOIN accounts ON users.id = accounts.accounts_id";

$result = mysqli_query($updated_con, $user_query);

// Kontoauszüge abfragen
$statements_query = "SELECT * FROM statements";
$result1 = mysqli_query($updated_con, $statements_query);

if ($result && $result1) {
    $user_list_data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $statements = mysqli_fetch_all($result1, MYSQLI_ASSOC);
    $statements = array_reverse($statements);
} else {
    echo "Kontoauszüge konnten nicht geladen werden";
}

?>

<h3><?php echo $dbuser; ?> Übersicht</h3><br>

<div id="statements">
    <table>
        <thead>
        <tr>
            <th>Sender</th>
            <th>Empfänger</th>
            <th>Betrag</th>
            <th>Verwendungszweck</th>
            <th>Datum</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($statements as $statement) : ?>
            <tr>
                <td>
                    <?php
                    $senderAccountNumber = $statement['account_number'];
                    $matchingUser = null;
                    foreach ($user_list_data as $user) {
                        if ($user['account_number'] == $senderAccountNumber) {
                            $matchingUser = $user;
                            break;
                        }
                    }
                    if ($matchingUser) {
                        echo $matchingUser['first_name'] . ' ' . $matchingUser['last_name'] ;
                        echo '<br>';
                        echo $statement['account_number'];
                    } else {
                        echo "-";
                    }
                    ?>
                </td>
                <td>
                    <?php
                    $receiverAccountNumber = $statement['receiver_id'];
                    $matchingUser = null;
                    foreach ($user_list_data as $user) {
                        if ($user['account_number'] == $receiverAccountNumber) {
                            $matchingUser = $user;
                            break;
                        }
                    }
                    if ($matchingUser) {
                        echo $matchingUser['first_name'] . ' ' . $matchingUser['last_name'];
                        echo '<br>';
                        echo $statement['receiver_id'];
                    } else {
                        echo "-";
                    }
                    ?>
                </td>
                <td><?php echo $statement['amount']; ?></td>
                <td><?php echo $statement['transaction_type']; ?></td>
                <td><?php echo $statement['transaction_date']; ?></td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>
</div>
