<?php
include 'db.php';

// 1. Ensure the setting row exists and is set to 1
mysqli_query($conn, "INSERT INTO game_status (id, imposter_limit) VALUES (1, 1) ON DUPLICATE KEY UPDATE imposter_limit = 1");

// 2. Fetch the setting
$query = mysqli_query($conn, "SELECT imposter_limit FROM game_status WHERE id = 1");
$setting = mysqli_fetch_assoc($query);
$current_limit = $setting['imposter_limit'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Imposter Settings</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<div class="manage-container">
    <div class="header-row">
        <a href="imposters.php" class="back-btn">
            <i class="fas fa-chevron-left"></i>
        </a>
        <h2>Imposters</h2>
    </div>

    <div class="imposter-list">
        <div class="imposter-option active">
            <div class="option-left">
                <span class="number-box">1</span>
                <span class="text">1 Imposter</span>
            </div>
            <div class="option-right">
                <i class="fas fa-check-circle check-icon"></i>
            </div>
        </div>
    </div>

    <p class="footer-note">
        Choose how many imposters will sneak in. The max depends on the number of players.
    </p>
</div>

</body>
</html>