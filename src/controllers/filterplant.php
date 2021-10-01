<?php
$plantInfo = [] ;

if ( isset($_POST['name']) ){
    $plantInfo['name'] = htmlspecialchars(trim(strtolower($_POST['name'])));
}
else{
    $plantInfo['name'] = ' ';

}
if ( isset($_POST['specie']) ){
    $plantInfo['specie'] = htmlspecialchars(trim(strtolower($_POST['specie'])));
}
else{
    $plantInfo['specie'] = ' ';

}
if ( isset($_POST['family']) ){
    $plantInfo['family'] = htmlspecialchars(trim(strtolower($_POST['family'])));
}
else{
    $plantInfo['family'] = ' ';
}


require_once('./src/models/plants.php');

$cards = filterPlants($plantInfo);
