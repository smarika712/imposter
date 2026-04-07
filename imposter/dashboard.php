<?php
session_start();
include 'db.php';
if (isset($_POST['start_game'])) {
    mysqli_query($conn, "UPDATE players SET role = 'Player'");
    $assign_imposter = "UPDATE players SET role = 'Imposter' ORDER BY RAND() LIMIT 1";
    
    if (mysqli_query($conn, $assign_imposter)) {
    header("Location: reveal.php?p=0"); 
    exit();
}
}
$player_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM players");
$p_data = mysqli_fetch_assoc($player_query);

?>

<!DOCTYPE html>
<html_entity_decode>
<head>
    <meta charset="UTF-8">
    <title>Guess the Imposter - Dashboard</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://kit.fontawesome.com/7988278f1b.js" crossorigin="anonymous"></script>
</head>
<body>

<div class="app-container">
    <div class="header-banner">
        <div class="imposter-icon"></div>
        <h1>Guess the <br><span>Imposter</span> <i class="fa-solid fa-masks-theater"></i></i></h1>
    </div>

    <div class="menu-list">
        
        <a href="players.php" class="menu-item">
            <div class="item-left">
                <span><i class="fa-solid fa-people-line"></i></span>
                <span class="label">Players</span>
            </div>
            <div class="item-right">
                <span class="value"><?php echo $p_data['total']; ?></span>
                <i class="fa-solid fa-greater-than"></i>
            </div>
        </a>

        <a href="imposters.php" class="menu-item">
    <div class="item-left">
        <span><i class="fa-solid fa-ghost"></i></span>
        <span class="label">Imposters</span>
    </div>
    <div class="item-right">
        <span class="value">1</span>
        <i class="fa-solid fa-greater-than"></i>
    </div>
</a>

    </div>

    <div class="footer-action">
    <p class="instruction">Each player secretly views their role — then the suspicion begins.</p>
    
    <form method="POST">
        <button type="submit" name="start_game" class="start-btn">START GAME</button>
    </form>
</div>

</body>
</html>