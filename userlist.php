<?php
session_start();

if ($_SESSION['role'] !== 'sachbearbeiter') {
    // Redirect -> Kein Zugang
    header("Location: unauthorized.php");
    exit();
}


include("worker_connection.php");
include("adminfunctions.php");

$user_data = check_login($workercon);

// Nutzerdaten abfragen
$user_query = "SELECT users.*, accounts.*
            FROM users 
            INNER JOIN accounts ON users.id = accounts.accounts_id";

$result = mysqli_query($workercon, $user_query);

if ($result) {
    $user_list_data = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    echo "Nutzer konnten nicht geladen werden";
}

?>

<h3><?php echo $dbuser; ?> Übersicht</h3><br>

<div id="statements">
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Login Name</th>
            <th>Kontonummer</th>
            <th>Kontostand</th>
            <th>Vorname</th>
            <th>Nachname</th>
            <th>Adresse</th>
            <th>Datum</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($user_list_data as $user) : ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['user_name']; ?></td>
                <td><?php echo $user['account_number']; ?></td>
                <td><?php echo $user['balance']; ?></td>
                <td><?php echo $user['first_name']; ?></td>
                <td><?php echo $user['last_name']; ?></td>
                <td>
                    <?php echo $user['street_name'], ' ', $user['street_number'], '<br>'; ?>
                    <?php echo $user['postal_code'], ' ', $user['city'], '<br>'; ?>
                </td>
                <td><?php echo $user['date']; ?></td>
                <td><?php echo $user['status']; ?></td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>
</div>
