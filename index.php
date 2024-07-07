<?php
// index.php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$stmt = $pdo->query("SELECT * FROM logbook_entries");
$items = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Logbook management</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2 style=" color:black;"> Weekly Activities</h2>
    <a href="add.php">Add weekly activities</a> | <a href="logout.php" style="background-color:#f2f2f2;">Logout</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Start-date</th>
            <th>End-date</th>
            <th>Day[MON-FRI]</th>
            <th>Week[number]</th>
            <th>Activity description</th>
            <th>Working hours/day</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($items as $item): ?>
            <tr>
                <td><?php echo $item['id']; ?></td>
                <td><?php echo $item['entry_date']; ?></td>
                <td><?php echo $item['entry_time']; ?></td>
                <td><?php echo $item['days']; ?></td>
                <td><?php echo $item['week']; ?></td>
                <td><?php echo $item['activitydescription']; ?></td>
                <td><?php echo $item['workinghours']; ?></td>
                <td>
                <a href="edit.php?id=<?php echo $item['id']; ?>" class="edit">Edit</a>
                <a href="delete.php?id=<?php echo $item['id']; ?>" class="delete">Delete</a>

                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
