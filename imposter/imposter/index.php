<?php
session_start();
include 'db.php';
if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    if ($user == "smarika" && $pass == "1234") {
        $_SESSION['smarika'] = $user;
        header("Location: dashboard.php");
    } else {
        $error = "Invalid Credentials!";
    }
}
?>
<!-- HTML for login page -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Imposter Game - Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <div class="login-container">
        <form action="dashboard.php" method="POST" class="login-card">
            <h1><i class="fa-solid fa-circle-user"></i>Login</h1>
            <i class="fa-solid fa-circle-user"></i>

            <div class="input-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="" required>
            </div>

            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="" required>
            </div>

            <button type="submit" name="login" class="login-btn">Login</button>
        </form>
    </div>
        
        <?php if(isset($error)) echo "<p style='color:pink; margin-top:10px;'>$error</p>"; ?>
    </form>
</body>
</html>