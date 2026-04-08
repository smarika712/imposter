<?php
include 'db.php';

$query = mysqli_query($conn, "SELECT * FROM players ORDER BY id ASC");
$players = mysqli_fetch_all($query, MYSQLI_ASSOC);

$currentIndex = isset($_GET['p']) ? (int)$_GET['p'] : 0;
$totalPlayers = count($players);

if ($currentIndex >= $totalPlayers) {
    header("Location: result.php");
    exit();
}

$currentPlayer = $players[$currentIndex];

// Handle vote submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $votedId = $_POST['vote'];

    mysqli_query($conn, "UPDATE players SET votes = votes + 1 WHERE id = $votedId");

    header("Location: vote.php?p=" . ($currentIndex + 1));
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vote Player</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="vote-container">
    <div class="card">
        <!-- Current Voter -->
        <p class="current-voter">It's <?php echo $currentPlayer['name']; ?>'s turn to vote</p>

        <!-- Player Name / Instruction -->
        <h2 class="player-name">Cast Your Vote</h2>

        <!-- Vote Options -->
        <form method="POST" class="vote-form">
            <?php foreach ($players as $player): ?>
                <?php if ($player['id'] != $currentPlayer['id']): ?>
                    <div class="vote-option">
                      <input type="radio" name="vote" value="<?php echo $player['id']; ?>" id="player-<?php echo $player['id']; ?>" required>
                      <label for="player-<?php echo $player['id']; ?>"><?php echo $player['name']; ?></label>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>

            <button type="submit" class="vote-btn">Submit Vote</button>
        </form>

        <p class="pass-text">Pass the device to the next player after voting.</p>
    </div>
</div>

</body>
</html>