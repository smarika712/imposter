<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h1>Welcome <?php echo $_SESSION['user']; ?></h1>

<a href="index.php">Go to Game</a><br><br>
<a href="logout.php">Logout</a>

</body>
</html>