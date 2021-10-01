<?php
    if ( isset($_GET['id']) && !empty($_GET['id'])){
        $id = $_GET['id'] ;
    }
    else {
        header('Location: ./index?msg=1');
        exit;
    }

    require_once('./src/models/plants.php');

    $plant = getOnePlant($id);

    $pageTitle = 'DicoFleur | Suppression de '. ucfirst($plant['name']) ;
    require_once('./templates/head.html');
        
    if (!isset($_SESSION['user']) || empty($_SESSION['user']) ) {
        header('Location: ./index?msg=11');
        exit;
    };
    require_once('./templates/message-box.html');

require_once('./templates/topbox-delplant.html');
    
    require_once('./templates/del-confirm.html');


    require_once('./templates/foot.html');

    ?>