<?php

require_once __DIR__ . '/vendor/autoload.php';

use Abasi\space\classes\Game;
use Abasi\space\classes\Spaceship;

session_start();

if (!isset($_SESSION['game'])) {
    $_SESSION['game'] = new Game();
}
$game = $_SESSION['game'];

if (isset($_POST['action'])) {
    $action = $_POST['action'];
    if ($action === 'shoot') {
        $game->playerShoot();
    } elseif ($action === 'move') {
        $game->playerMove();
    }
}

if (!isset($_SESSION['score'])) {
    $_SESSION['score'] = 0;
}

if ($game->enemy->hitPoints <= 0) {
    $_SESSION['score'] += 10;
    $_SESSION['game'] = new Game();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spaceship Game</title>
    <style>
        body {
            background-image: url('img/space.png');
            background-repeat: no-repeat;
            background-size: cover;
            color: white;
            font-family: Arial, sans-serif;
            text-align: center;
        }

        .scoreboard, .game-info {
            font-size: 18px;
            margin: 20px auto;
            padding: 10px;
            width: 80%;
            max-width: 400px;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 8px;
        }

        .spaceship {
            width: 100px;
            position: relative;
        }

        #playerSpaceship {
            position: absolute;
            left: 100px;
            top: 300px;
        }

        #enemySpaceship {
            position: absolute;
            left: 500px;
            top: 300px;
        }

        .controls {
            margin-top: 20px;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        .bullet {
            width: 10px;
            height: 10px;
            background-color: yellow;
            position: absolute;
            top: 320px;
            left: 120px;
            border-radius: 50%;
            display: none;
            transition: transform 0.5s linear;
        }
    </style>
</head>
<body>
<h1>Spaceship Game</h1>

<div class="scoreboard">
    <h2>Scoreboard</h2>
    <p>Current Score: <span id="score"><?php echo $_SESSION['score']; ?></span></p>
</div>

<div class="game-info">
    <div>
        <h2>Player</h2>
        <img src="img/ship2.png" alt="Player Spaceship" id="playerSpaceship" class="spaceship">
        <p>Ammo: <?php echo $game->player->ammo; ?></p>
        <p>HP: <?php echo $game->player->hitPoints; ?></p>
    </div>

    <div>
        <h2>Enemy</h2>
        <img src="img/ship.jpg" alt="Enemy Spaceship" id="enemySpaceship" class="spaceship">
        <p>Ammo: <?php echo $game->enemy->ammo; ?></p>
        <p>HP: <?php echo $game->enemy->hitPoints; ?></p>
    </div>
</div>

<div id="bullet" class="bullet"></div>

<div class="controls">
    <form method="post" id="actionForm">
        <button type="button" onclick="submitAction('shoot')">Shoot</button>
        <button type="button" onclick="submitAction('move')">Move</button>
    </form>
</div>
</body>
</html>
