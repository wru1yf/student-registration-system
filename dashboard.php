<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <h2>Welcome</h2>
    <p><strong><?php echo htmlspecialchars($_SESSION["fullname"]); ?></strong></p>
    <p>You have successfully logged in.</p>
    <a href="logout.php" style="display: inline-block; width:100%; padding:14px; border:none; border-radius:10px; background:#403F48; color:white; font-size:16px; font-weight:bold; text-decoration: none; text-align:center; cursor:pointer;">Logout</a>
</div>
</body>
</html>
