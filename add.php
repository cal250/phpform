<?php
// add.php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $entry_date = $_POST['entry_date'];
    $entry_time = $_POST['entry_time'];
    $days = $_POST['days'];
    $week = $_POST['week'];
    $activitydescription = $_POST['activitydescription'];
    $workinghours = $_POST['workinghours'];

    $stmt = $pdo->prepare("INSERT INTO logbook_entries (entry_date, entry_time,  days, week, activitydescription, workinghours) VALUES (?, ?, ?, ?, ?, ?)");
    if ($stmt->execute([$entry_date, $entry_time, $days, $week, $activitydescription, $workinghours])) {
        header("Location: index.php");
    } else {
        echo "Error: Could not add entry.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add activity</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body style="background-image: url(images/Nov-17-Anschutz-updates-electronic-logbook-system.jpg);">
    <h2>Add activity</h2>
    <form method="post">
        <label>Starting date</label>
        <input type="date" name="entry_date" style=" width:600px; height:25px" required>
        <label>Ending date</label>
        <input type="date" name="entry_time"  style=" width:600px; height:25px" required>
        <label>Day[Mon-Fri]</label>
        <input type="text" name="days"  style=" width:600px; height:25px" required>
        <label>Week[number]</label>
        <input type="number" name="week"  style=" width:600px; height:25px" required>
        <label>Activity description</label>
        <textarea name="activitydescription"  style=" width:600px;" required></textarea>
        <label>Working hours/day</label>
        <input type="text" name="workinghours"  style=" width:600px; height:25px" required>
        <button type="submit">Add</button>
        <p><a href="index.php">Back </a></p>
    </form>
</body>
</html>
