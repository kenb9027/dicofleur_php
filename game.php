<?php
$pageTitle = 'DicoFleur | Entrainement';
require_once('./src/models/plants.php');
$plants = getAllPlants();
shuffle($plants);
if (
    isset($_GET['game-size']) &&
    !empty($_GET['game-size']) &&
    ($_GET['game-size'] <= 800) &&
    ($_GET['game-size'] >= 1) &&
    ($_GET['game-size'] <= count($plants))
) {
    $size = $_GET['game-size'];
} else {

        $size = count($plants);
}

require_once('./templates/head.html');

require_once('./templates/message-box.html');

require_once('./templates/topbox-gametest.html');

require_once('./templates/game-card-box.html');


require_once('./templates/foot.html');
