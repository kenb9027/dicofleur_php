<?php
if ( isset($_GET['id']) && !empty($_GET['id'])){
    $id = $_GET['id'];
}
else{
    header('Location', './index?msg=1');
    exit;
}

require_once('./src/models/plants.php');
$plant = getOnePlant($id);
$nextPlant = getNextPlant($id);
$previousPlant = getPreviousPlant(($id));

$pageTitle = "DicoFleur | " . ucfirst($plant['name']) ;

require_once('./templates/head.html');
require_once('./templates/message-box.html');


require_once('./templates/single-card.html');

    
require_once('./templates/foot.html');

?>
