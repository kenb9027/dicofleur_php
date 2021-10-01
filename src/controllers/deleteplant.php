<?php
if ( isset($_GET['id']) && !empty($_GET['id'])){
    $id = $_GET['id'] ;
}
else {
    header('Location: ../../error.php?msg=1');
    exit;
}
require_once('../models/plants.php');

if (deletePlant($id)){
    $authExtension = array('gif', 'jpg', 'jpe', 'jpeg', 'png');
    foreach($authExtension as $extension){
        if (file_exists('../../public/img/' . $id .'.'. $extension)){
            unlink('../../public/img/' . $id .'.'. $extension);
        }
    }
    header('Location: ../../index.php?msg=12');
    exit;
}
else {
    header('Location: ../../error.php?msg=1');
    exit;
}