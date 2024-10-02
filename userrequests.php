<?php
session_start();

if ($_SESSION['role'] !== 'sachbearbeiter') {
    // Redirect to an unauthorized page or display an error message
    header("Location: unauthorized.php");
    exit();
}

include("worker_connection.php");
include("adminfunctions.php");

$user_data = check_login($workercon);


// Nutzerdaten abfragen
$user_query = "SELECT users.*, accounts.*
                FROM users 
                INNER JOIN accounts ON users.id = accounts.accounts_id
                WHERE users.status = 'deactivated'";

$result = mysqli_query($workercon, $user_query);

if ($result) {
    $user_list_data = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    echo "Nutzer konnten nicht geladen werden";
}
?>

<h3><?php echo $dbuser; ?> Übersicht</h3><br>

<div id="statements">
    <form class="acceptuserform" method="POST">
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Login Name</th>
                <th>Vorname</th>
                <th>Nachname</th>
                <th>Adresse</th>
                <th>Datum</th>
                <th>Status</th>
                <th>Aktion</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($user_list_data as $user) : ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['user_name']; ?></td>
                    <td><?php echo $user['first_name']; ?></td>
                    <td><?php echo $user['last_name']; ?></td>
                    <td>
                        <?php echo $user['street_name'], ' ', $user['street_number'], '<br>'; ?>
                        <?php echo $user['postal_code'], ' ', $user['city'], '<br>'; ?>
                    </td>
                    <td><?php echo $user['date']; ?></td>
                    <td><?php echo $user['status']; ?></td>
                    <td>
                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                        <button class="acceptuserbutton" type="submit" name="confirm_button_<?php echo $user['id']; ?>">Bestätigen</button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </form>
</div>
