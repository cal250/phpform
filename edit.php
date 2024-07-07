    <?php
// edit.php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM logbook_entries WHERE id = ?");
$stmt->execute([$id]);
$item = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $entry_date = $_POST['entry_date'];
    $entry_time = $_POST['entry_time'];
    $days = $_POST['days'];
    $week = $_POST['week'];
    $activitydescription = $_POST['activitydescription'];
    $workinghours = $_POST['workinghours'];

    
    
    $stmt = $pdo->prepare("UPDATE logbook_entries SET entry_date = ?, entry_time  = ?, days = ?, week = ?, activitydescription = ?, workinghours = ? WHERE id = ?");
    if ($stmt->execute([$entry_date, $entry_time, $days, $week, $activitydescription, $workinghours, $id])) {
        header("Location: index.php");
    } else {
        echo "Error: Could not update entry.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit activity</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body style="background-image: url(images/Nov-17-Anschutz-updates-electronic-logbook-system.jpg);">
    <h2>Edit activity</h2>
    <form method="post">
        <label >Starting date</label>
        <input type="date"   style=" width:600px; height:25px" name="entry_date" value="<?php echo $item['entry_date']; ?>" required>
        <label>Ending date</label>
        <input type="date"  style=" width:600px; height:25px" name="entry_time" value="<?php echo $item['entry_time']; ?>" required>
        <label>Day[MON-FRI]</label>
        <input type="text"  style=" width:600px; height:25px" name="days" value="<?php echo $item['days']; ?>" required>
        <label>Week[number]</label>
        <input type="number"  style=" width:600px; height:25px" name="week" value="<?php echo $item['week']; ?>" required>
        <label> Activity description</label>
        <textarea name="activitydescription"  style=" width:600px; "  required><?php echo $item['activitydescription']; ?></textarea>
        <label>Working hours/day</label>
        <input type="text"  style=" width:600px; height:25px" name="workinghours" value="<?php echo $item['workinghours']; ?>" required>
        <button type="submit">Update</button>
        <p><a href="index.php">Back </a></p>
    </form>
</body>
</html>
