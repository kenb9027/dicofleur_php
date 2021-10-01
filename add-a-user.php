<?php 

    $pageTitle = 'DicoFleur | Ajouter Administrateur';
    require_once('./templates/head.html');

    if (!isset($_SESSION['user']) || empty($_SESSION['user']) ) {
        header('Location: ./index?msg=11');
        exit;
    };
    require_once('./templates/message-box.html');
require_once('./templates/topbox-adduser.html');

    require_once('./templates/form-adduser.html');

    

    require_once('./templates/foot.html');
