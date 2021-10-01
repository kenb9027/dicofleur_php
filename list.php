<?php

$pageTitle = 'DicoFleur | Liste des végétaux';
require_once('./src/models/pagination.php');

$count = getPaginationPlantsCount();
require_once('./templates/head.html');

if (isset($_POST['limit']) && !empty($_POST['limit']) && $_POST['limit'] >= 1 && $_POST['limit'] <= 99) {
    $limit = $_POST['limit'];
    $_SESSION['limit'] = $limit;
} elseif (isset($_SESSION['limit']) && !empty($_SESSION['limit'])) {
    $limit = intval($_SESSION['limit']);
} else {
    $limit = 6;
}

$nbPages = ceil($count / $limit);

if (isset($_GET['page']) && !empty($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

if (isset($_POST['offset']) && !empty($_POST['offset'])){
    $offset = $_POST['offset'];
}
else{
    $offset = ($page - 1) * $limit;

}



$cards = getPaginationPlants($limit, $offset);


require_once('./templates/message-box.html');

require_once('./templates/topbox-list.html');

require_once('./templates/card-list.html');

require_once('./templates/foot.html');
