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
$selected_user = "";

if (isset($_POST['selected_user'])) {
    $selected_user = $_POST['selected_user'];
}

// Nutzerdaten abfragen
$user_query = "SELECT users.*, accounts.*
            FROM users 
            INNER JOIN accounts ON users.id = accounts.accounts_id";

$result = mysqli_query($admincon, $user_query);

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
            <th>Passwort</th>
            <th>Kontonummer</th>
            <th>Kontostand</th>
            <th>Vorname</th>
            <th>Nachname</th>
            <th>Adresse</th>
            <th>Rolle</th>
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
                <td><?php echo $user['password']; ?></td>
                <td><?php echo $user['account_number']; ?></td>
                <td><?php echo $user['balance']; ?></td>
                <td><?php echo $user['first_name']; ?></td>
                <td><?php echo $user['last_name']; ?></td>
                <td>
                    <?php echo $user['street_name'], ' ', $user['street_number'], '<br>'; ?>
                    <?php echo $user['postal_code'], ' ', $user['city'], '<br>'; ?>
                </td>
                <td><?php echo $user['role']; ?></td>
                <td><?php echo $user['date']; ?></td>
                <td><?php echo $user['status']; ?></td>
                <td>
                    <form method="post" action="edituser.php">
                        <input type="hidden" name="selected_user" value="<?php echo $user['id']; ?>">
                        <button type="submit" class="acceptuserbutton">bearbeiten</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>

</div>

