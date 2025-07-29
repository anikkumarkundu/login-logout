<?php
session_start();
if(!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Home</title>
</head>
<body>
<div class="container">
    <h2>Welcome, <?php echo $_SESSION['user']; ?>!</h2>
    <p>You are logged in successfully.</p>
    <a href="logout.php"><button>Logout</button></a>
</div>
</body>
</html>
