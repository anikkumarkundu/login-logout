<?php
session_start();
include "db.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM register WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if(password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user['username'];
            header("Location: index.php");
            exit();
        } else {
            $error = "Incorrect Password!";
        }
    } else {
        $error = "User not found! Please Register.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <title>Login</title>
</head>
<body>
<div class="container">
    <h2>Login</h2>
    <?php if(!empty($error)) echo "<p style='color:red'>$error</p>"; ?>
    <?php if(isset($_GET['success']) && $_GET['success']=='registered') echo "<p style='color:green'>Registration Successful! Please Login.</p>"; ?>
    <form method="POST" onsubmit="return validateLogin()">
        <input type="text" id="login_username" name="username" placeholder="Username" required>
        <input type="password" id="login_password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
    <p>New user? <a href="register.php">Register</a></p>
</div>
</body>
</html>
