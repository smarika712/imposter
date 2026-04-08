<?php
include 'db.php';

// Logic to add a player
if (isset($_POST['add_player'])) {
    $name = $_POST['player_name'];
    mysqli_query($conn, "INSERT INTO players (name, role) VALUES ('$name', 'Player')");
    header("Location: players.php");
}

// Logic to reset players
if (isset($_POST['reset_players'])) {
    mysqli_query($conn, "TRUNCATE TABLE players");
    header("Location:players.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Manage Players</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://kit.fontawesome.com/7988278f1b.js" crossorigin="anonymous"></script>
</head>
<body>

<div class="manage-container">
    <div class="header-row">
        <a href="dashboard.php" class="back-btn"><i class="fas fa-chevron-left"></i></a>
        <h2>Players</h2>
    </div>

    <div class="player-list">
        <?php
        $result = mysqli_query($conn, "SELECT * FROM players");
        while ($row = mysqli_fetch_assoc($result)) {
            echo "
            <div class='player-item'>
                <span>{$row['name']}</span>
                <i class='fas fa-pencil-alt edit-icon'></i>
            </div>";
        }
        ?>
    </div>

    <div class="actions">
        <form method="POST" class="add-form">
            <input type="text" name="player_name" placeholder="Enter name..." required>
            <button type="submit" name="add_player" class="black-btn">+ Add Player</button>
        </form>

        <form method="POST">
            <button type="submit" name="reset_players" class="reset-link">Reset players</button>
        </form>
    </div>
</div>

</body>
</html>