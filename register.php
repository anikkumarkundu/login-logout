<?php
session_start();
include "db.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $district = $_POST['district'];
    $state = $_POST['state'];
    $pin = $_POST['pin'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $checkUser = $conn->prepare("SELECT * FROM register WHERE username=? OR email=?");
    $checkUser->bind_param("ss", $username, $email);
    $checkUser->execute();
    $result = $checkUser->get_result();

    if($result->num_rows > 0) {
        $error = "Username or Email already exists!";
    } else {
        $stmt = $conn->prepare("INSERT INTO register(first_name,last_name,gender,email,phone,city,district,state,pin_code,username,password)
            VALUES(?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssssssss", $fname,$lname,$gender,$email,$phone,$city,$district,$state,$pin,$username,$password);
        if($stmt->execute()) {
            header("Location: login.php?success=registered");
            exit();
        } else {
            $error = "Registration failed!";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <title>Register</title>
</head>
<body>
<div class="container">
    <h2>Registration</h2>
    <?php if(!empty($error)) echo "<p style='color:red'>$error</p>"; ?>
    <form method="POST" onsubmit="return validateRegistration()">
        <input type="text" name="fname" placeholder="First Name" required>
        <input type="text" name="lname" placeholder="Last Name" required>
        <select name="gender" required>
            <option value="">Select Gender</option>
            <option>Male</option>
            <option>Female</option>
            <option>Others</option>
        </select>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="phone" placeholder="Phone Number" required>
        <input type="text" name="city" placeholder="City" required>
        <input type="text" name="district" placeholder="District" required>
        <input type="text" name="state" placeholder="State" required>
        <input type="text" name="pin" placeholder="Pin Code" required>
        <input type="text" id="username" name="username" placeholder="Username" required>
        <input type="password" id="password" name="password" placeholder="Password" required>
        <button type="submit">Register</button>
    </form>
    <p>Already registered? <a href="login.php">Login</a></p>
</div>
</body>
</html>
