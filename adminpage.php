<?php 

    $pageTitle = 'DicoFleur | Espace Administrateur' ;
    
    require_once('./templates/head.html');
    // if (!isset($_SESSION['user']) || empty($_SESSION['user']) ) {
    //     header('Location: ./index?msg=11');
    //     exit;
    // };
    require_once('./templates/message-box.html');
    require_once('./templates/topbox-admin.html');

    require_once('./templates/admin-links.html');

    require_once('./templates/foot.html');

    ?>