<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body style="background-image: url(images/Nov-17-Anschutz-updates-electronic-logbook-system.jpg);">
    <h2>Sign Up</h2>
    <form method="post">
        <label>Username</label>
        <input type="text" name="username" required>
        <label>Email</label>
        <input type="email"  name="email" required>
        <label>Password</label>
        <input type="password" name="password" required>
        <button type="submit">Sign Up</button>
        <p >Already have an account? <a href="login.php" >login </a> | <a href="landingpage.php">Back home</a> </p>
    </form>
    <?php
// signup.php
session_start();
require 'config.php';
$error = ''; // Initialize error variable

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Check if the username already exists
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM user_student WHERE username = ?");
    $stmt->execute([$username]);
    $user_studentExists = $stmt->fetchColumn();

    if ($user_studentExists) {
        $error = "Error: Username already taken. Please choose a different username.";
        echo $error;
    } else {
        // Proceed with the insertion if the username does not exist
        $stmt = $pdo->prepare("INSERT INTO user_student (username, email, password) VALUES (?, ?, ?)");
        if ($stmt->execute([$username, $email, $password])) {
            header("Location: login.php");
            exit(); // Make sure to exit after redirecting
        } else {
            $error = "Error: Could not register user.";
         
        }
    }
}

?> 

</body>
</html>