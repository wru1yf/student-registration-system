<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "db_connect.php"; 

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = trim($_POST["fullname"]);
    $email = trim($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $check_sql = "SELECT id FROM users WHERE email = ?";
    if ($check_stmt = mysqli_prepare($conn, $check_sql)) {
        mysqli_stmt_bind_param($check_stmt, "s", $email);
        mysqli_stmt_execute($check_stmt);
        mysqli_stmt_store_result($check_stmt);
        
        if (mysqli_stmt_num_rows($check_stmt) > 0) {
            $message = "This email is already registered!";
        } else {
            $sql = "INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)";
            if ($stmt = mysqli_prepare($conn, $sql)) {
                mysqli_stmt_bind_param($stmt, "sss", $fullname, $email, $password);
                if (mysqli_stmt_execute($stmt)) {
                    $message = "Registration Successful!";
                } else {
                    $message = "Something went wrong.";
                }
                mysqli_stmt_close($stmt);
            }
        }
        mysqli_stmt_close($check_stmt);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <h2>Student Registration</h2>
    
    <?php if (!empty($message)): ?>
        <?php $color = ($message == "Registration Successful!") ? "#596C68" : "#A74A4A"; ?>
        <p style="color: <?php echo $color; ?>; text-align: center; font-weight: bold; margin-bottom: 15px;">
            <?php echo $message; ?>
        </p>
    <?php endif; ?>

    <form method="POST" action="">
        <input type="text" name="fullname" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="index.php">Login</a></p>
</div>
</body>
</html>
