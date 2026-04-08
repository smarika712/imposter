<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db.php'; // Make sure db.php exists in the same folder

$query = mysqli_query($conn, "SELECT * FROM players ORDER BY id ASC");
$players = mysqli_fetch_all($query, MYSQLI_ASSOC);

$currentIndex = isset($_GET['p']) ? (int)$_GET['p'] : 0;
$totalPlayers = count($players);

if ($currentIndex >= $totalPlayers) {
    header("Location: vote.php?p=0");
    exit();
}

$currentPlayer = isset($players[$currentIndex]) ? $players[$currentIndex] : null;
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reveal Role</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="reveal-body">

    <div class="reveal-header">Guess the Imposter</div>

    <div class="reveal-container">
        <div class="card" id="roleCard" onclick="revealRole()">
            
            <h1 class="player-name"><?php echo $currentPlayer['name']; ?></h1>
            <p class="tap-instruction" id="instruction">Tap to reveal</p>
            
            <div id="roleText" class="role-display" style="display: none;">
                <span class="role-value"><?php echo $currentPlayer['role']; ?></span>
            </div>
        </div>

      <div class="reveal-footer">
    <?php if ($currentIndex < $totalPlayers - 1): ?>
        <a href="reveal.php?p=<?php echo $currentIndex + 1; ?>" class="next-btn">
            Next Player
        </a>
        <p class="pass-text">Pass phone to the next player.</p>
        
    <?php else: ?>
        <a href="vote.php?p=0" class="start-game-btn">
            Start Game
        </a>
        <p class="pass-text">All set? Let's start the game!</p>
    <?php endif; 
    ?>
</div>

    <script>
    function revealRole() {
        const instruction = document.getElementById('instruction');
        const roleText = document.getElementById('roleText');
        instruction.style.display = 'none';
        roleText.style.display = 'block';
    }
    </script>

</body>
</html>