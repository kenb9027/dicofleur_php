<?php
$pageTitle = 'DicoFleur | Evaluation - choix du nombre de questions';
require_once('./src/models/plants.php');
$plants = getAllPlants();
$maxSize = count($plants);

require_once('./templates/head.html');
require_once('./templates/message-box.html');

require_once('./templates/topbox-gameform.html');


require_once('./templates/game-form-sizeform.html');



require_once('./templates/foot.html');
