<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);
$account_number = $user_data["account_number"];

// Kontoauszüge abfragen
$query = "SELECT account_number, receiver_id, transaction_type, amount, transaction_date FROM statements WHERE account_number = $account_number OR receiver_id = $account_number";
$result = mysqli_query($con, $query);

if ($result) {
    $statements = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $statements = array_reverse($statements);
} else {
    echo "Error retrieving statements from the database.";
}

?>

<h3>Giro Kontonummer:&nbsp;<?php echo $account_number; ?></h3><br>

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
                <td><?php echo ($statement['transaction_type'] === 'Einzahlung' || $statement['transaction_type'] === 'Auszahlung') ? "-" : ($statement['account_number'] === $account_number ? "Sie" : $statement['account_number']); ?></td>
                <td>
                    <?php
                    if ($statement['transaction_type'] === 'Auszahlung') {
                        echo '-';
                    } elseif ($statement['receiver_id'] === $account_number && $statement['transaction_type'] !== 'Auszahlung') {
                        echo 'Sie';
                    } else {
                        echo $statement['receiver_id'];
                    }
                    ?>
                </td>
                <td>
                    <?php
                    if ($statement['transaction_type'] === 'Auszahlung' ) {
                        echo '-' . $statement['amount'];
                    } elseif (!($statement['transaction_type'] === 'Einzahlung') && $statement['account_number'] === $account_number) {
                        echo '-' . $statement['amount'];
                    } else {
                        echo '+' . $statement['amount'];
                    }
                    ?>
                </td>
                <td><?php echo $statement['transaction_type']; ?></td>
                <td><?php echo $statement['transaction_date']; ?></td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>
</div>
