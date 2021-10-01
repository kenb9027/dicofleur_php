<?php
$pageTitle = 'DicoFleur | Accueil';
require_once('./src/models/plants.php');
$cards = getLastPlants(6);

require_once('./templates/head.html');

require_once('./templates/message-box.html');

require_once('./templates/main-home.html');

require_once('./templates/last-plants-list-carrou.html');

$plants = getAllPlants();
shuffle($plants);
$size = 3 ;

require_once('./templates/game-box-index.html');

require_once('./templates/foot.html');
