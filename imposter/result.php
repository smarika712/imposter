<?php
include 'db.php';
// Fetch all players with votes (descending order)
$query = mysqli_query($conn, "SELECT * FROM players ORDER BY votes DESC");
$players = mysqli_fetch_all($query, MYSQLI_ASSOC);

// Determine the player with most votes
$mostVoted = $players[0];

// Find the real imposter
$realImposterQuery = mysqli_query($conn, "SELECT * FROM players WHERE role='Imposter' LIMIT 1");
$realImposter = mysqli_fetch_assoc($realImposterQuery);

// Determine if imposter got caught
if ($mostVoted['id'] == $realImposter['id']) {
    $imposterStatus = "The Imposter {$realImposter['name']} got caught!";
} elseif ($realImposter['votes'] == 0) {
    $imposterStatus = "The Imposter {$realImposter['name']} escaped without being voted!";
} else {
    $imposterStatus = "The Imposter {$realImposter['name']} was not caught.";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Voting Results</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div>
        <div class="result-card">
            <h1>Voting Results</h1>
            <p class="imposter">Imposter: <?php echo $realImposter['name']; ?> (<?php echo $realImposter['votes']; ?> votes)</p>

            <?php foreach ($players as $player): 
                $classes = "vote-box";
                if ($player['id'] == $mostVoted['id']) $classes .= " most-voted";
                if ($player['role'] == "Imposter") $classes .= " imposter";
            ?>
                <div class="<?php echo $classes; ?>">
                    <?php echo $player['name']; ?> - <?php echo $player['votes']; ?> votes
                </div>
            <?php endforeach; ?>

            <p class="status-message"><?php echo $imposterStatus; ?></p>
            <p class="game-over">Game Over!</p>
        </div>

        <!-- Dashboard button below the card -->
        <div style="text-align:center; margin-top: 15px;">
            <a href="dashboard.php" class="dashboard-btn">Back to Dashboard</a>
        </div>
    </div>
</body>
</html>